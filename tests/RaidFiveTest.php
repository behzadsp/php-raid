<?php
namespace kevinquinnyo\Raid\Test;

use \PHPUnit\Framework\TestCase;
use \kevinquinnyo\Raid\Drive;
use \kevinquinnyo\Raid\Raid\RaidFive;

class RaidFiveTest extends TestCase
{
    public function testGetCapacity()
    {
        $drives = [
            new Drive(1024, 'ssd'),
            new Drive(1024, 'ssd'),
            new Drive(1024, 'ssd'),
        ];
        $raidFive = new RaidFive($drives);
        $this->assertSame(2048, $raidFive->getCapacity());
        $this->assertSame('2 KB', $raidFive->getCapacity(['human' => true]));
    }
    public function testGetCapacityWithHotSpares()
    {
        $drives = [
            new Drive(1024, 'ssd'),
            new Drive(1024, 'ssd'),
            new Drive(1024, 'ssd'),
            new Drive(1024, 'ssd', ['hotSpare' => true]),
            new Drive(1024, 'ssd', ['hotSpare' => true]),
        ];
        $raidFive = new RaidFive($drives);
        $this->assertSame(2048, $raidFive->getCapacity());
    }
    public function testGetLevel()
    {
        $raidFive = new RaidFive();
        $this->assertSame(5, $raidFive->getLevel());
    }
}
