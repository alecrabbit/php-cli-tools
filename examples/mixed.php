<?php declare(strict_types=1);

use AlecRabbit\Cli\Tools\Cursor;
use AlecRabbit\Cli\Tools\Line;
use AlecRabbit\Cli\Tools\Screen;
use AlecRabbit\Cli\Tools\Symbol;

require_once __DIR__ . '/../vendor/autoload.php';

echo Screen::clear();
echo Cursor::goTo();
for ($i = 0; $i < 10; $i++) {
    echo str_repeat((string)$i, 20) . PHP_EOL;
}
$line = '91376459837649817639481723647805634875621987630187266660601283761042387604123784612038716487236081576';
sleep(1);
echo Cursor::goTo(4, 4) . 'X';
echo Symbol::insert(2) . 'aa';
sleep(1);
echo Symbol::delete(2);
sleep(1);
echo Symbol::replaceWithSpace(2) . '22';
sleep(1);
echo Line::insert(2);// insert 2 lines
sleep(1);
echo Line::delete(2); // delete 2 lines
echo Cursor::goTo(20, 11) . 'X';
echo Cursor::goTo(1, 12) . 'X';
echo $line;
echo Cursor::goTo(31, 12) . 'X';
sleep(1);
echo Line::eraseFromCursor();
sleep(1);
echo Line::eraseToCursor();
sleep(1);
echo Cursor::goTo(1, 12) . 'X';
echo $line;
echo Cursor::goTo(31, 12) . 'X';
sleep(1);
echo Line::erase();
echo Cursor::goTo(11, 14);

for ($i = 0; $i < 10; $i++) {
    echo str_repeat((string)$i, 20) . PHP_EOL;
}
echo Cursor::goTo(31, 12) . 'X';
sleep(1);
echo Screen::eraseFromCursor();
sleep(1);

echo Screen::eraseToCursor();
