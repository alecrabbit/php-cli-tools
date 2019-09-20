<?php declare(strict_types=1);

namespace AlecRabbit\Tests\ConsoleColour;

use AlecRabbit\Cli\Tools\Cursor;
use AlecRabbit\Cli\Tools\Line;
use AlecRabbit\Cli\Tools\Screen;
use AlecRabbit\Cli\Tools\Symbol;
use AlecRabbit\Tests\Helper;
use PHPUnit\Framework\TestCase;

class CursorTest extends TestCase
{
    /**
     * @test
     * @dataProvider sequences
     * @param string $expected
     * @param string $actual
     */
    public function escapedSequences(string $expected, string $actual): void
    {

        $this->assertEquals(Helper::stripEscape($expected), Helper::stripEscape($actual));
    }

    /**
     * @test
     * @dataProvider sequences
     * @param string $expected
     * @param string $actual
     */
    public function rawSequences(string $expected, string $actual): void
    {

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function forCoverage(): void
    {
        $this->assertEquals("\033[1@", Symbol::insert());
        $this->assertEquals("\033[1P", Symbol::delete());
        $this->assertEquals("\033[1@", Symbol::insert(1));
        $this->assertEquals("\033[1P", Symbol::delete(1));
        $this->assertEquals("\033[2@", Symbol::insert(2));
        $this->assertEquals("\033[2P", Symbol::delete(2));
        $this->assertEquals("\033[1X", Symbol::replaceWithSpace());
        $this->assertEquals("\033[1X", Symbol::replaceWithSpace());
        $this->assertEquals("\033[2X", Symbol::replaceWithSpace(2));
        $this->assertEquals("\033[2J", Screen::clear());
        $this->assertEquals("\033[1J", Screen::eraseToCursor());
        $this->assertEquals("\033[0J", Screen::eraseFromCursor());
        $this->assertEquals("\033[2K", Line::erase());
        $this->assertEquals("\033[1K", Line::eraseToCursor());
        $this->assertEquals("\033[0K", Line::eraseFromCursor());
        $this->assertEquals("\033[1L", Line::insert());
        $this->assertEquals("\033[1M", Line::delete());
        $this->assertEquals("\033[1L", Line::insert(1));
        $this->assertEquals("\033[1M", Line::delete(1));
        $this->assertEquals("\033[2L", Line::insert(2));
        $this->assertEquals("\033[2M", Line::delete(2));
        $this->assertEquals("\033[?25h", Cursor::show());
//        $this->assertEquals("\033[?25h\033[?0c", Cursor::show());
        $this->assertEquals("\033[?25l", Cursor::hide());
        $this->assertEquals("\033[1A", Cursor::up());
        $this->assertEquals("\033[3A", Cursor::up(3));
        $this->assertEquals("\033[1B", Cursor::down());
        $this->assertEquals("\033[3B", Cursor::down(3));
        $this->assertEquals("\033[1C", Cursor::forward());
        $this->assertEquals("\033[3C", Cursor::forward(3));
        $this->assertEquals("\033[1D", Cursor::back());
        $this->assertEquals("\033[3D", Cursor::back(3));
        $this->assertEquals("\033[1;1f", Cursor::goTo());
        $this->assertEquals("\033[2;3f", Cursor::goTo(3, 2));
        $this->assertEquals("\033[s", Cursor::savePosition());
        $this->assertEquals("\033[u", Cursor::restorePosition());
        $this->assertEquals("\0337", Cursor::save());
        $this->assertEquals("\0338", Cursor::restore());
        $this->assertEquals("\033[1F", Cursor::upLine());
        $this->assertEquals("\033[1E", Cursor::downLine());
        $this->assertEquals("\033[1G", Cursor::absX());
        $this->assertEquals("\033[1d", Cursor::absY());
        $this->assertEquals("\033[1F", Cursor::upLine(1));
        $this->assertEquals("\033[1E", Cursor::downLine(1));
        $this->assertEquals("\033[1G", Cursor::absX(1));
        $this->assertEquals("\033[1d", Cursor::absY(1));
        $this->assertEquals("\033[2F", Cursor::upLine(2));
        $this->assertEquals("\033[2E", Cursor::downLine(2));
        $this->assertEquals("\033[2G", Cursor::absX(2));
        $this->assertEquals("\033[2d", Cursor::absY(2));
    }

    public function sequences(): array
    {
        return [
            ["\033[1@", Symbol::insert()],
            ["\033[1P", Symbol::delete()],
            ["\033[1@", Symbol::insert(1)],
            ["\033[1P", Symbol::delete(1)],
            ["\033[2@", Symbol::insert(2)],
            ["\033[2P", Symbol::delete(2)],
            ["\033[1X", Symbol::replaceWithSpace()],
            ["\033[1X", Symbol::replaceWithSpace()],
            ["\033[2X", Symbol::replaceWithSpace(2)],
            ["\033[2J", Screen::clear()],
            ["\033[1J", Screen::eraseToCursor()],
            ["\033[0J", Screen::eraseFromCursor()],
            ["\033[2K", Line::erase()],
            ["\033[1K", Line::eraseToCursor()],
            ["\033[0K", Line::eraseFromCursor()],
            ["\033[1L", Line::insert()],
            ["\033[1M", Line::delete()],
            ["\033[1L", Line::insert(1)],
            ["\033[1M", Line::delete(1)],
            ["\033[2L", Line::insert(2)],
            ["\033[2M", Line::delete(2)],
            ["\033[?25h", Cursor::show()],
//            ["\033[?25h\033[?0c", Cursor::show()],
            ["\033[?25l", Cursor::hide()],
            ["\033[1A", Cursor::up()],
            ["\033[3A", Cursor::up(3)],
            ["\033[1B", Cursor::down()],
            ["\033[3B", Cursor::down(3)],
            ["\033[1C", Cursor::forward()],
            ["\033[3C", Cursor::forward(3)],
            ["\033[1D", Cursor::back()],
            ["\033[3D", Cursor::back(3)],
            ["\033[1;1f", Cursor::goTo()],
            ["\033[2;3f", Cursor::goTo(3, 2)],
            ["\033[s", Cursor::savePosition()],
            ["\033[u", Cursor::restorePosition()],
            ["\0337", Cursor::save()],
            ["\0338", Cursor::restore()],
            ["\033[1F", Cursor::upLine()],
            ["\033[1E", Cursor::downLine()],
            ["\033[1G", Cursor::absX()],
            ["\033[1d", Cursor::absY()],
            ["\033[1F", Cursor::upLine(1)],
            ["\033[1E", Cursor::downLine(1)],
            ["\033[1G", Cursor::absX(1)],
            ["\033[1d", Cursor::absY(1)],
            ["\033[2F", Cursor::upLine(2)],
            ["\033[2E", Cursor::downLine(2)],
            ["\033[2G", Cursor::absX(2)],
            ["\033[2d", Cursor::absY(2)],
        ];
    }
}