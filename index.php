<?php
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);

spl_autoload_register(function ($className) {
    $className = end(explode('\\', $className));
    if (file_exists(getcwd() . "/{$className}.php")) {
        require_once getcwd() . "/{$className}.php";
    } else {
        $dirs = [
            'src',
            'src/alliance',
            'src/character',
            'src/contracts',
            'src/corporation',
            'src/fw',
            'src/incursions',
            'src/industry',
            'src/insurance',
            'src/logger',
            'src/loyalty',
            'src/market',
            'src/sso',
        ];
        foreach ($dirs as $dir) {
            if (file_exists(getcwd() . "/{$dir}/{$className}.php")) {
                require_once getcwd() . "/{$dir}/{$className}.php";
            }
        }
    }
});

set_exception_handler(function ($exception) {
    $code = $exception->getCode();
    $message = $exception->getMessage();
    $file = $exception->getFile();
    $line = $exception->getLine();
    $msg = <<<MSG
<h3>$code: $message in $file:$line</h3>
MSG;

    echo $msg;
});

$api = new \DenisKhodakovskiyESI\EVESwaggerAPI();
$sso = $api->sso();
if (isset($_GET['auth'])) {
    if (isset($_GET['code'])) {
        $token = $sso->getAccessToken($_GET['code']);
        file_put_contents('/var/www/html/esi/.token', serialize($token));
        Header("Location: /");
    } else {
        Header("Location: " . $sso->getAuthUrl($sso->getScopesList()));
    }
} elseif (isset($_GET['refresh'])) {
    /**
     * @var \DenisKhodakovskiyESI\src\sso\SSOToken $token
     */
    $token = file_exists('/var/www/html/esi/.token')
        ? unserialize(file_get_contents('/var/www/html/esi/.token'))
        : null;

    if ($token) {
        $token = $sso->refreshToken($token->refreshToken);
        file_put_contents('/var/www/html/esi/.token', serialize($token));
        Header("Location: /");
    } else {
        echo "Err0r";
    }
} else {
    /**
     * @var \DenisKhodakovskiyESI\src\sso\SSOToken $token
     */
    $token = file_exists('/var/www/html/esi/.token')
        ? unserialize(file_get_contents('/var/www/html/esi/.token'))
        : null;

    $characterId = 523375194;
    $corpId = 98482170;
    $npcCorpId = 1000127;
    $regionId = 10000020; //Tash-Murkon
    $typeId = 2346;

    $bika = 30002252;
    $jita = 30000142;
    $amarr = 30002187;
    $gaha = 30002204;
    $ivar = 30002524;

    $oxrgn = 30004521;
    $tz6j2 = 30004529;

    $character = $sso->getCharacter($token->accessToken);
    \DenisKhodakovskiyESI\Dumper::printR(
        $character->assetsLocations([1017026838682, 1020020533619, 1020020949060])
    );
}
