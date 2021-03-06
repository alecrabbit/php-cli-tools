<?php declare(strict_types=1);

namespace AlecRabbit\Tests\ConsoleColour;

use AlecRabbit\Cli\Terminal;
use PHPUnit\Framework\TestCase;
use const AlecRabbit\ALLOWED_COLOR_TERMINAL;
use const AlecRabbit\COLOR256_TERMINAL;
use const AlecRabbit\COLOR_TERMINAL;
use const AlecRabbit\NO_COLOR_TERMINAL;
use const AlecRabbit\TRUECOLOR_TERMINAL;

class TerminalTest extends TestCase
{
    /**
     * @test
     * @dataProvider basicDataProvider
     * @param array $expected
     */
    public function basic(array $expected): void
    {
        [$width, $height, $color] = $expected;
        $terminal = new Terminal($color, $width, $height);
        $this->assertSame($width, $terminal->width());
        $this->assertSame($height, $terminal->height());
        $this->assertSame($color, $terminal->color());
    }

    /**
     * @test
     * @dataProvider nullableDataProvider
     * @param array $expected
     */
    public function nullable(array $expected): void
    {
        [$width, $height, $color] = $expected;
        $terminal = new Terminal($color, $width, $height);
        $this->assertIsInt($terminal->width());
        $this->assertIsInt($terminal->height());
        $this->assertIsInt($terminal->color());
    }

    /** @test */
    public function color(): void
    {
        $terminal = new Terminal();
        $this->assertIsInt($terminal->width());
        $this->assertIsInt($terminal->height());
        $this->assertIsInt($terminal->color());
        $this->assertContains($terminal->color(), ALLOWED_COLOR_TERMINAL);
    }

    public function basicDataProvider(): array
    {
        return
            [
                [[100, 60, COLOR_TERMINAL]],
                [[80, 50, NO_COLOR_TERMINAL]],
                [[80, 50, TRUECOLOR_TERMINAL]],
                [[81, 52, COLOR256_TERMINAL]],
            ];
    }

    public function nullableDataProvider(): array
    {
        return [
            [[80, null, null],],
            [[null, 60, null],],
            [[null, null, NO_COLOR_TERMINAL],],
            [[null, null, null],],
        ];
    }


    /**
     * @test
     * @dataProvider throwsDataProvider
     * @param array $expected
     * @param array $args
     */
    public function throws(array $expected, array $args): void
    {
        [$width, $height, $color] = $args;
        [$exceptionClass, $expectedExceptionMessage] = $expected;
        $this->expectException($exceptionClass);
        $this->expectExceptionMessage($expectedExceptionMessage);
        new Terminal($color, $width, $height);
    }

    public function throwsDataProvider(): array
    {
        return [
            [
                [\RuntimeException::class, 'Unknown color support level.'],
                [20, 20, 23],
            ],
            [
                [\RuntimeException::class, 'Terminal size bounds exceeded.'],
                [-10, 30, NO_COLOR_TERMINAL],
            ],
            [
                [\RuntimeException::class, 'Terminal size bounds exceeded.'],
                [30, 1000, NO_COLOR_TERMINAL],
            ],
        ];
    }

    public function inRangeDataProvider(): array
    {
        return [
            [true, [2, 1, 2]],
            [true, [1, 1, 2]],
            [true, [10, 10, 22]],
            [true, [10, 22, 10]],
            [false, [0, 1, 2]],
            [false, [-10, 20, 280]],
            [false, [1000, 20, 280]],
        ];
    }
}