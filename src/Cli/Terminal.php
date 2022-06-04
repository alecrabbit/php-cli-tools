<?php
declare(strict_types=1);

namespace AlecRabbit\Cli;

use AlecRabbit\Cli\Tools\Core\Contracts\TerminalInterface;
use AlecRabbit\Cli\Tools\Core\Terminal as StaticTerminal;

use function AlecRabbit\Helpers\inRange;

use const AlecRabbit\ALLOWED_COLOR_TERMINAL;

class Terminal implements TerminalInterface
{
    protected const MIN_WIDTH = 20;
    protected const MAX_WIDTH = 280;

    protected const MIN_HEIGHT = 20;
    protected const MAX_HEIGHT = 80;

    protected int $width;
    protected int $height;
    protected int $color;

    public function __construct(?int $colorSupport = null, ?int $width = null, ?int $height = null)
    {
        $this->width = $this->refineWidth($width);
        $this->height = $this->refineHeight($height);
        $this->color = $this->refineColorSupport($colorSupport);
    }

    protected function refineWidth(?int $width): int
    {
        $this->assertWidth($width);
        return $width ?? StaticTerminal::width();
    }

    protected function assertWidth(?int $width): void
    {
        if (null !== $width && !inRange($width, static::MIN_WIDTH, static::MAX_WIDTH)) {
            throw new \RuntimeException('Terminal size bounds exceeded.');
        }
    }

    public function width(): int
    {
        return $this->width;
    }

    protected function refineHeight(?int $height): int
    {
        $this->assertHeight($height);
        return $height ?? StaticTerminal::height();
    }

    protected function assertHeight(?int $height): void
    {
        if (null !== $height && !inRange($height, static::MIN_HEIGHT, static::MAX_HEIGHT)) {
            throw new \RuntimeException('Terminal size bounds exceeded.');
        }
    }

    public function height(): int
    {
        return $this->height;
    }

    protected function refineColorSupport(?int $colorSupport): int
    {
        $this->assertColorSupport($colorSupport);
        return $colorSupport ?? StaticTerminal::colorSupport();
    }

    protected function assertColorSupport(?int $colorSupport): void
    {
        if (null !== $colorSupport && !\in_array($colorSupport, ALLOWED_COLOR_TERMINAL, true)) {
            throw new \RuntimeException('Unknown color support level.');
        }
    }

    public function color(): int
    {
        return $this->color;
    }
}
