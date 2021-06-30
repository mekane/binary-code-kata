<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once('processor.php');

final class ProcessorTest extends TestCase
{
    /** @test */
    public function processorFunctionReturnsNullIfNoInput(): void
    {
        $actual = process([]);
        $this->assertNull($actual);
    }

    /** @test */
    public function processorFunctionReturnsNullIfNeverStarted(): void
    {
        $actual = process(['Bogus', 'Add', 'Sub', 'End']);
        $this->assertNull($actual);
    }

    /** @test */
    public function processorFunctionReturnsZeroAfterStarting(): void
    {
        $actual = process(['Start']);
        $this->assertSame(0, $actual);
    }

    /** @test */
    public function processorFunctionReturnsOneForOneAdd(): void
    {
        $actual = process(['Start', 'Add']);
        $this->assertEquals(1, $actual);
    }

    /** @test */
    public function processorFunctionReturnsMinusOneForOneSubtract(): void
    {
        $actual = process(['Start', 'Sub']);
        $this->assertEquals(-1, $actual);
    }

    /** @test */
    public function processorFunctionReturnsArithmeticResults(): void
    {
        $actual = process(['Start', 'Add', 'Sub', 'Add', 'Add', 'Sub', 'Add']);
        $this->assertEquals(2, $actual);
    }

    /** @test */
    public function processorFunctionStopsAtEnd(): void
    {
        $actual = process(['Start', 'Add', 'End', 'Add', 'Add', 'Sub', 'Add']);
        $this->assertEquals(1, $actual);
    }
}
