<?php declare(strict_types=1);

namespace AlecRabbit\Cli\Tools;

use const AlecRabbit\ESC;

class Symbol
{
    public static function insert(int $num = 1): string {
        return  ESC . "[{$num}@";
    }

    public static function delete(int $num = 1): string {
        return  ESC . "[{$num}P";
    }

    public static function replaceWithSpace(int $num = 1): string {
        return  ESC . "[{$num}X";
    }
}
