<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Unit;

use AlecRabbit\Cli\Tools\Stream;
use PHPUnit\Framework\TestCase;

class StreamTest extends TestCase
{
    /** @test */
    public function basic(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Expecting parameter 1 to be resource, boolean given');
        Stream::hasColorSupport(false);
    }
}