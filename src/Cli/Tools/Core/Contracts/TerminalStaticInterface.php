<?php declare(strict_types=1);

namespace AlecRabbit\Cli\Tools\Core\Contracts;

/**
 * Interface TerminalInterface
 *
 * @author AlecRabbit
 */
interface TerminalStaticInterface
{
    /**
     * @param bool $recheck
     * @return int
     */
    public static function width(bool $recheck = false): int;

    /**
     * @param bool $recheck
     * @return int
     */
    public static function height(bool $recheck = false): int;

    /**
     * @param bool $recheck
     * @return bool
     */
    public static function supports256Color(bool $recheck = false): bool;

    /**
     * @param bool $recheck
     * @return bool
     */
    public static function supportsColor(bool $recheck = false): bool;

    /**
     * Returns set title ESC sequence
     *
     * @param string $title
     * @return string
     */
    public static function setTitle(string $title): string;

    /**
     * Returns color support level
     *
     * @return int
     */
    public static function colorSupport(): int;
}