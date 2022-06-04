<?php declare(strict_types=1);

namespace AlecRabbit\Cli\Tools;

use const AlecRabbit\ENV_COLORTERM;
use const AlecRabbit\ENV_DOCKER_TERM;
use const AlecRabbit\ENV_TERM;
use const AlecRabbit\NEEDLE_256_COLOR;
use const AlecRabbit\NEEDLE_TRUECOLOR;
use const AlecRabbit\XTERM;

class EnvCheck
{
    public static function isXTerm(): bool
    {
        return
            static::checkEnvVariable(ENV_TERM, XTERM) ||
            static::checkEnvVariable(ENV_DOCKER_TERM, XTERM);
    }

    protected static function checkEnvVariable(string $varName, string $checkFor): bool
    {
        if ($t = getenv($varName)) {
            return
                str_contains($t, $checkFor);
        }
        return false;
    }

    public static function has256ColorSupport(): bool
    {
        return
            static::checkEnvVariable(ENV_TERM, NEEDLE_256_COLOR) ||
            static::checkEnvVariable(ENV_DOCKER_TERM, NEEDLE_256_COLOR);
    }

    public static function hasTrueColorSupport(): bool
    {
        return
            static::checkEnvVariable(ENV_COLORTERM, NEEDLE_TRUECOLOR);
    }
}
