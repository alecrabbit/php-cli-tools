<?php declare(strict_types=1);

namespace AlecRabbit\Tests\ConsoleColour;

use AlecRabbit\Cli\Tools\Core\Terminal;
use AlecRabbit\Cli\Tools\EnvCheck;
use AlecRabbit\Tests\Helper;
use PHPUnit\Framework\TestCase;
use function AlecRabbit\Helpers\callMethod;
use const AlecRabbit\COLOR256_TERMINAL;
use const AlecRabbit\TRUECOLOR_TERMINAL;

class StaticTerminalTest extends TestCase
{
    /** @test */
    public function basic(): void
    {
        putenv('COLUMNS=100');
        putenv('LINES=50');

        $this->assertSame(100, Terminal::width());
        $this->assertSame(50, Terminal::height());

        putenv('COLUMNS=120');
        putenv('LINES=60');

        $this->assertNotEquals(120, Terminal::width());
        $this->assertNotEquals(60, Terminal::height());
        $this->assertSame(120, Terminal::width(true));
        $this->assertSame(60, Terminal::height(true));
    }

    /** @test */
    public function zeroValues(): void
    {
        putenv('COLUMNS=0');
        putenv('LINES=0');

        $this->assertNotEquals(0, Terminal::width());
        $this->assertNotEquals(0, Terminal::height());
        $this->assertSame(0, Terminal::width(true));
        $this->assertSame(0, Terminal::height(true));
    }

    /** @test */
    public function colorSupport(): void
    {
        $colorLevel = Terminal::colorSupport(STDOUT);
        $this->assertIsInt($colorLevel);
        if ($this->checkTermVarFor256ColorSupport('TERM') ||
            $this->checkTermVarFor256ColorSupport('DOCKER_TERM')) {
            $this->assertTrue($colorLevel >= COLOR256_TERMINAL);
        } else {
            $this->assertFalse($colorLevel >= COLOR256_TERMINAL);
        }
        if ($this->checkTermVarForTruecolorSupport('COLORTERM')) {
            $this->assertTrue($colorLevel >= TRUECOLOR_TERMINAL);
        } else {
            $this->assertFalse($colorLevel >= TRUECOLOR_TERMINAL);
        }
        $this->assertFalse(
            callMethod(EnvCheck::class, 'checkEnvVariable', 'UNKNOWN_VAR', 'value')
        );
        $this->assertSame($colorLevel, Terminal::colorSupport(STDOUT));
    }

    /**
     * @param string $varName
     * @return bool
     */
    protected function checkTermVarFor256ColorSupport(string $varName): bool
    {
        if ($t = getenv($varName)) {
            return
                false !== strpos($t, '256color');
        }
        return false;
    }

    /**
     * @param string $varName
     * @return bool
     */
    protected function checkTermVarForTruecolorSupport(string $varName): bool
    {
        if ($t = getenv($varName)) {
            return
                false !== strpos($t, 'truecolor');
        }
        return false;
    }

    /** @test */
    public function setTitle(): void
    {
        $title = 'Title';
        if (($t = getenv('TERM')) && (false !== strpos($t, 'xterm'))) {
            $this->assertEquals(
                Helper::stripEscape("\033]0;{$title}\007"),
                Helper::stripEscape(Terminal::setTitle($title))
            );
            $this->assertEquals(
                "\033]0;{$title}\007",
                Terminal::setTitle($title)
            );
        } else {
            $this->assertEquals(
                '',
                Terminal::setTitle($title)
            );
        }

    }

}
