<?php declare(strict_types=1);

use AlecRabbit\Cli\Tools\Terminal;
use const AlecRabbit\COLOR256_TERMINAL;
use const AlecRabbit\COLOR_TERMINAL;
use const AlecRabbit\NO_COLOR_TERMINAL;

require_once __DIR__ . '/../vendor/autoload.php';

$t = new Terminal();

$colorSupport = [
    NO_COLOR_TERMINAL => 'no color',
    COLOR_TERMINAL => 'color',
    COLOR256_TERMINAL => '256 color',
];
echo 'Terminal width: ' . $t->width() . PHP_EOL;
echo 'Terminal height: ' . $t->height() . PHP_EOL;
echo 'Terminal color support: ' . $colorSupport[$t->color()] . PHP_EOL;
