<?php declare(strict_types=1);

namespace AlecRabbit\Cli\Tools\Core\Contracts;

/**
 * Interface TerminalInterface
 *
 * @author AlecRabbit
 */
interface TerminalInterface
{
    /**
     * @param bool $recheck
     * @return int
     */
    public function width(bool $recheck = false): int;

    /**
     * @param bool $recheck
     * @return int
     */
    public function height(bool $recheck = false): int;

    /**
     * @param bool $recheck
     * @return bool
     */
    public function supports256Color(bool $recheck = false): bool;

    /**
     * @param bool $recheck
     * @return bool
     */
    public function supportsColor(bool $recheck = false): bool;

    /**
     * Returns set title ESC sequence
     *
     * @param string $title
     * @return string
     */
    public static function setTitle(string $title): string;
}