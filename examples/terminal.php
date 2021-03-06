<?php declare(strict_types=1);

use AlecRabbit\Cli\Terminal;
use const AlecRabbit\TERMINAL_COLOR_MODES;

require_once __DIR__ . '/../vendor/autoload.php';

$t = new Terminal();

echo 'Terminal width: ' . $t->width() . PHP_EOL;
echo 'Terminal height: ' . $t->height() . PHP_EOL;
echo 'Max color mode: ' . TERMINAL_COLOR_MODES[$t->color()] . PHP_EOL;
