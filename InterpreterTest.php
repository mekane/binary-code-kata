<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once('interpreter.php');

final class InterpreterTest extends TestCase
{
    /** @test */
    public function interpreterFunctionReturnsAnArray(): void
    {
        $actual = interpret('');
        $this->assertIsArray($actual);
    }

    /** @test */
    public function interpreterIgnoresBadInputs(): void
    {
        $emptyInput = interpret('');
        $this->assertSame([], $emptyInput);

        $bogusInput = interpret('foobar');
        $this->assertSame([], $bogusInput);

        $closeButNotRealInput = interpret('02120912');
        $this->assertSame([], $closeButNotRealInput);
    }

    /** @test */
    public function interprets00AsStart(): void
    {
        $actual = interpret('00');
        $this->assertSame(['Start'], $actual);
    }

    /** @test */
    public function interprets01AsAdd(): void
    {
        $actual = interpret('01');
        $this->assertSame(['Add'], $actual);
    }

    /** @test */
    public function interprets10AsSubtract(): void
    {
        $actual = interpret('10');
        $this->assertSame(['Sub'], $actual);
    }

    /** @test */
    public function interprets11AsEnd(): void
    {
        $actual = interpret('11');
        $this->assertSame(['End'], $actual);
    }

    /** @test */
    public function interpretsSeriesOfCodes(): void
    {
        $actual = interpret('000101101011');
        $this->assertSame(['Start', 'Add', 'Add', 'Sub', 'Sub', 'End'], $actual);
    }

    /** @test */
    public function ignoresIncompleteMessage(): void
    {
        $actual = interpret('00010110101');
        $this->assertSame(['Start', 'Add', 'Add', 'Sub', 'Sub'], $actual);
    }
}
