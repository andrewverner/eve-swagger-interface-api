<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 29.09.18
 * Time: 12:41
 */

namespace DenisKhodakovskiyESI\src;

class Route
{
    const FLAG_SHORTEST = 'shortest';
    const FLAG_INSECURE = 'insecure';
    const FLAG_SECURE   = 'secure';

    /**
     * Start solar system Id
     * @var int
     */
    private $origin;

    /**
     * End solar system Id
     * @var int
     */
    private $destination;

    /**
     * Array of avoid solar systems
     * @var int[]
     */
    private $avoid;

    /**
     * Array of additional solar system Ids you want to visit
     * @var int[]
     */
    /*private $connections;*/

    /**
     * Route security preference (shortest, secure, insecure)
     * @var string
     */
    private $flag = 'shortest';

    /**
     * Route constructor.
     * @param $fromSolarSystemId
     * @param $toSolarSystemId
     * @param string $flag
     */
    public function __construct($fromSolarSystemId, $toSolarSystemId, $flag = 'shortest')
    {
        $this->origin = $fromSolarSystemId;
        $this->destination = $toSolarSystemId;
        $this->flag = $flag;
    }

    /*public function through(array $solarSystemIds)
    {
        $this->connections = implode(',', $solarSystemIds);
        return $this;
    }*/

    /**
     * Solar systems Ids to avoid
     * @param array $solarSystemIds
     * @return $this
     */
    public function avoid(array $solarSystemIds)
    {
        $this->avoid = implode(',', $solarSystemIds);
        return $this;
    }

    /**
     * Get the systems between origin and destination
     * @return int[] Solar systems Ids
     * @throws \Exception
     */
    public function build()
    {
        $params = ['flag' => $this->flag];
        if ($this->avoid) {
            $params['avoid'] = $this->avoid;
        }

        return (new Request("/route/{$this->origin}/{$this->destination}/"))
            ->setData($params)
            ->execute();
    }
}
