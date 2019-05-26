<?php declare(strict_types=1);

namespace AlecRabbit\Cli\Tools;

use const AlecRabbit\ESC;

class Cursor
{
    /**
     * Show cursor sequence
     *
     * @return string
     */
    public static function show(): string
    {
        return ESC . '[?25h' . ESC . '[?0c';
    }

    /**
     * Hide cursor sequence
     *
     * @return string
     */
    public static function hide(): string
    {
        return ESC . '[?25l';
    }

    /**
     * Move cursor up sequence
     *
     * @param int $rows
     * @return string
     */
    public static function up(int $rows = 1): string
    {
        return ESC . "[{$rows}A";
    }

    /**
     * Move cursor down sequence
     *
     * @param int $rows
     * @return string
     */
    public static function down(int $rows = 1): string
    {
        return ESC . "[{$rows}B";
    }

    /**
     * Move cursor forward sequence
     *
     * @param int $cols
     * @return string
     */
    public static function forward(int $cols = 1): string
    {
        return ESC . "[{$cols}C";
    }

    /**
     * Move cursor back sequence
     *
     * @param int $cols
     * @return string
     */
    public static function back(int $cols = 1): string
    {
        return ESC . "[{$cols}D";
    }

    /**
     * Move cursor to sequence
     *
     * @param int $col
     * @param int $row
     * @return string
     */
    public static function goTo(int $col = 1, int $row = 1): string
    {
        return ESC . "[{$row};{$col}f";
    }

    /**
     * Save cursor position sequence
     *
     * @return string
     */
    public static function savePosition(): string
    {
        return ESC . '[s';
    }

    /**
     * Restore cursor position sequence
     *
     * @return string
     */
    public static function restorePosition(): string
    {
        return ESC . '[u';
    }

    /**
     * Save cursor position and attributes sequence
     *
     * @return string
     */
    public static function save(): string
    {
        return ESC . '7';
    }

    /**
     * Restore cursor position and attributes sequence
     *
     * @return string
     */
    public static function restore(): string
    {
        return ESC . '8';
    }
}
