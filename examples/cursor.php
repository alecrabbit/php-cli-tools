<?php declare(strict_types=1);

use AlecRabbit\Cli\Tools\Cursor;
use const AlecRabbit\ESC;

require_once __DIR__ . '/../vendor/autoload.php';

for ($i = 0; $i < 10; $i++) {
    echo $i . '. *' . PHP_EOL;
}
echo '   ';
sleep(1);
echo Cursor::savePosition();
echo ' ';

for ($i = 0; $i < 10; $i++) {
    echo Cursor::up();
    echo Cursor::back();
    echo '-';
    usleep(300000);
}
usleep(300000);
echo Cursor::restorePosition();
echo '*';
echo PHP_EOL;
echo ESC . '[31mDone!' . ESC . '[0;m' . PHP_EOL;

