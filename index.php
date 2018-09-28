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
            'src/logger',
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

$characterId = 523375194;
$corpId = 98482170;

$api = new \DenisKhodakovskiyESI\EVESwaggerAPI();
\DenisKhodakovskiyESI\Dumper::printR(
    $api->eve->industrySystems()
);
