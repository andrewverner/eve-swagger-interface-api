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
            'src/assets',
            'src/bookmarks',
            'src/calendar',
            'src/character',
            'src/clones',
            'src/contacts',
            'src/contracts',
            'src/corporation',
            'src/fleets',
            'src/fw',
            'src/incursions',
            'src/industry',
            'src/insurance',
            'src/killmails',
            'src/location',
            'src/logger',
            'src/loyalty',
            'src/mail',
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

$api = new \DenisKhodakovskiyESI\EVESwaggerAPI(
    'de03de3a63a8483ea901c6e351efe7f4',
    'JY7KkviD1wk162WbARa7712W95zXXLsTKJbC5VIw',
    'http://esi.local/?auth=1'
);
$sso = $api->sso();
if (isset($_GET['auth'])) {
    if (isset($_GET['code'])) {
        $token = $sso->getAccessToken($_GET['code']);
        file_put_contents('/var/www/html/esi/package/.token', serialize($token));
        Header("Location: /");
    } else {
        Header("Location: " . $sso->getAuthUrl(array_keys($sso->getScopesList())));
    }
} elseif (isset($_GET['refresh'])) {
    /**
     * @var \DenisKhodakovskiyESI\src\sso\SSOToken $token
     */
    $token = file_exists('/var/www/html/esi/package/.token')
        ? unserialize(file_get_contents('/var/www/html/esi/package/.token'))
        : null;

    if ($token) {
        $token = $sso->refreshToken($token->refreshToken);
        file_put_contents('/var/www/html/esi/package/.token', serialize($token));
        Header("Location: /");
    } else {
        echo "Err0r";
    }
} else {
    /**
     * @var \DenisKhodakovskiyESI\src\sso\SSOToken $token
     */
    $token = file_exists('/var/www/html/esi/package/.token')
        ? unserialize(file_get_contents('/var/www/html/esi/package/.token'))
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

    $elvira = 534122154;

    //$fleetInvite = new \DenisKhodakovskiyESI\src\fleets\FleetInvitation(\DenisKhodakovskiyESI\src\fleets\FleetInvitation::ROLE_FLEET_COMMANDER);
    #$fleetInvite->squadId = 1;
    #$fleetInvite->wingId = 1;
    //var_dump($fleetInvite->validate());
    $character = $sso->getCharacter($token->accessToken);
    //$corp = $api->corporation($character->info()->corporationId, $token->accessToken);
    $fleet = $character->fleet();
    /*$fleet->isFreeMove = true;
    $fleet->motd = 'Blah blah blah';*/
    /*$invite = $fleet->createInvite(\DenisKhodakovskiyESI\src\fleets\CharacterFleet::ROLE_WING_COMMANDER);
    $invite->characterId = $elvira;
    $invite->wingId = 2143211473514;*/
    \DenisKhodakovskiyESI\Dumper::printR(
        $fleet->deleteWing(2143211473514)
    );
}
