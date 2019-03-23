<?php

use Serafim\Opcache\Opcache;

require __DIR__ . '/vendor/autoload.php';

$opcache = new Opcache();
$file = $opcache->open(__DIR__ . '/example.php.bin');

dump($file);
