<?php declare(strict_types=1);

namespace AlecRabbit\Cli\Tools;

use AlecRabbit\Cli\Tools\Core\TerminalCore as TerminalCoreAlias;
use const AlecRabbit\ALLOWED_COLOR_TERMINAL;

class Terminal
{
    protected const MIN_WIDTH = 20;
    protected const MAX_WIDTH = 280;
    protected const MIN_HEIGHT = 20;
    protected const MAX_HEIGHT = 80;

    /** @var int */
    protected $width;
    /** @var int */
    protected $height;
    /** @var int */
    protected $color;

    public function __construct(int $width = null, int $height = null, int $colorSupport = null)
    {
        $this->width = $this->refineWidth($width);
        $this->height = $this->refineHeight($height);
        $this->color = $this->refineColorSupport($colorSupport);
    }

    /**
     * @param int $width
     * @return int
     */
    protected function refineWidth(?int $width): int
    {
        $this->assertWidth($width);
        return $width ?? TerminalCoreAlias::width();
    }

    protected function assertWidth(?int $width): void
    {
        if (null !== $width && !$this->inRange($width, static::MIN_WIDTH, static::MAX_WIDTH)) {
            throw new \RuntimeException('Terminal size bounds exceeded.');
        }
    }

    /**
     * @param int $height
     * @return int
     */
    protected function refineHeight(?int $height): int
    {
        $this->assertHeight($height);
        return $height ?? TerminalCoreAlias::height();
    }

    protected function assertHeight(?int $height): void
    {
        if (null !== $height && !$this->inRange($height, static::MIN_HEIGHT, static::MAX_HEIGHT)) {
            throw new \RuntimeException('Terminal size bounds exceeded.');
        }
    }

    /**
     * @param int $colorSupport
     * @return int
     */
    protected function refineColorSupport(?int $colorSupport): int
    {
        $this->assertColorSupport($colorSupport);
        return $colorSupport ?? TerminalCoreAlias::colorSupport();
    }

    /**
     * @param int $colorSupport
     */
    protected function assertColorSupport(?int $colorSupport): void
    {
        if (null !== $colorSupport && !\in_array($colorSupport, ALLOWED_COLOR_TERMINAL, true)) {
            throw new \RuntimeException('Unknown color support level.');
        }
    }

    /**
     * @return int
     */
    public function width(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function height(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function color(): int
    {
        return $this->color;
    }

    /**
     * @param int $value
     * @param int $min
     * @param int $max
     * @return bool
     */
    protected function inRange(int $value, int $min, int $max): bool
    {
        if ($min > $max) {
            [$min, $max] = [$max, $min];
        }
        return ($min <= $value && $value <= $max);
    }
}
