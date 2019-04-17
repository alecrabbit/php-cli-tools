<?php declare(strict_types=1);

namespace AlecRabbit\Tests\ConsoleColour;

use AlecRabbit\Cli\Tools\Core\TerminalCore;
use AlecRabbit\Tests\Helper;
use PHPUnit\Framework\TestCase;
use function AlecRabbit\Helpers\callMethod;

class TerminalCoreTest extends TestCase
{
    /** @test */
    public function basic(): void
    {
        putenv('COLUMNS=100');
        putenv('LINES=50');

        $this->assertSame(100, TerminalCore::width());
        $this->assertSame(50, TerminalCore::height());

        putenv('COLUMNS=120');
        putenv('LINES=60');

        $this->assertNotEquals(120, TerminalCore::width());
        $this->assertNotEquals(60, TerminalCore::height());
        $this->assertSame(120, TerminalCore::width(true));
        $this->assertSame(60, TerminalCore::height(true));
    }

    /** @test */
    public function zeroValues(): void
    {
        putenv('COLUMNS=0');
        putenv('LINES=0');

        $this->assertNotEquals(0, TerminalCore::width());
        $this->assertNotEquals(0, TerminalCore::height());
        $this->assertSame(0, TerminalCore::width(true));
        $this->assertSame(0, TerminalCore::height(true));
    }

    /** @test */
    public function colorSupport(): void
    {
        $this->assertTrue(TerminalCore::supportsColor());
        if ($this->checkTermVarFor256ColorSupport('TERM') ||
            $this->checkTermVarFor256ColorSupport('DOCKER_TERM')) {
            $this->assertTrue(TerminalCore::supports256Color());
            $this->assertTrue(TerminalCore::supports256Color());
        } else {
            $this->assertFalse(TerminalCore::supports256Color());
            $this->assertFalse(TerminalCore::supports256Color());
        }
        $this->assertFalse(callMethod(new TerminalCore(), 'checkEnvVariable', 'UNKNOWN_VAR', 'value'));
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
        $this->assertEquals(
            Helper::stripEscape("\033]0;{$title}\007"),
            Helper::stripEscape(TerminalCore::setTitle($title))
        );
        $this->assertEquals(
            "\033]0;{$title}\007",
            TerminalCore::setTitle($title)
        );
    }

}