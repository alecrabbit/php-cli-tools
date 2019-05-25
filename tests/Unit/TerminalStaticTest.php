<?php declare(strict_types=1);

namespace AlecRabbit\Tests\ConsoleColour;

use AlecRabbit\Cli\Tools\Core\TerminalStatic;
use AlecRabbit\Tests\Helper;
use PHPUnit\Framework\TestCase;
use function AlecRabbit\Helpers\callMethod;

class TerminalStaticTest extends TestCase
{
    /** @test */
    public function basic(): void
    {
        putenv('COLUMNS=100');
        putenv('LINES=50');

        $this->assertSame(100, TerminalStatic::width());
        $this->assertSame(50, TerminalStatic::height());

        putenv('COLUMNS=120');
        putenv('LINES=60');

        $this->assertNotEquals(120, TerminalStatic::width());
        $this->assertNotEquals(60, TerminalStatic::height());
        $this->assertSame(120, TerminalStatic::width(true));
        $this->assertSame(60, TerminalStatic::height(true));
    }

    /** @test */
    public function zeroValues(): void
    {
        putenv('COLUMNS=0');
        putenv('LINES=0');

        $this->assertNotEquals(0, TerminalStatic::width());
        $this->assertNotEquals(0, TerminalStatic::height());
        $this->assertSame(0, TerminalStatic::width(true));
        $this->assertSame(0, TerminalStatic::height(true));
    }

    /** @test */
    public function colorSupport(): void
    {
        $this->assertIsBool(TerminalStatic::supportsColor());
        if ($this->checkTermVarFor256ColorSupport('TERM') ||
            $this->checkTermVarFor256ColorSupport('DOCKER_TERM')) {
            $this->assertTrue(TerminalStatic::supports256Color());
        } else {
            $this->assertFalse(TerminalStatic::supports256Color());
        }
        $this->assertFalse(callMethod(new TerminalStatic(), 'checkEnvVariable', 'UNKNOWN_VAR', 'value'));
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

    /** @test */
    public function setTitle(): void
    {
        $title = 'Title';
        if (($t = getenv('TERM')) && (false !== strpos($t, 'xterm'))) {
            $this->assertEquals(
                Helper::stripEscape("\033]0;{$title}\007"),
                Helper::stripEscape(TerminalStatic::setTitle($title))
            );
            $this->assertEquals(
                "\033]0;{$title}\007",
                TerminalStatic::setTitle($title)
            );
        } else {
            $this->assertEquals(
                '',
                TerminalStatic::setTitle($title)
            );
        }
        
    }

}
