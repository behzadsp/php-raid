<?php
namespace behzadsp\Raid\Test\Raid;

use \PHPUnit\Framework\TestCase;
use \behzadsp\Raid\Drive;
use \behzadsp\Raid\Raid\RaidSix;

class RaidSixTest extends TestCase
{
    public function testGetCapacity()
    {
        $drives = [
            new Drive(1024, 'ssd', 1),
            new Drive(1024, 'ssd', 2),
            new Drive(1024, 'ssd', 3),
            new Drive(1024, 'ssd', 4),
        ];
        $raidSix = new RaidSix($drives);
        $this->assertSame(2048, $raidSix->getCapacity());
        $this->assertSame('2 KB', $raidSix->getCapacity(['human' => true]));
    }
    public function testGetCapacityWithHotSpares()
    {
        $drives = [
            new Drive(1024, 'ssd', 1),
            new Drive(1024, 'ssd', 2),
            new Drive(1024, 'ssd', 3),
            new Drive(1024, 'ssd', 4),
            new Drive(1024, 'ssd', 5, ['hotSpare' => true]),
            new Drive(1024, 'ssd', 6, ['hotSpare' => true]),
        ];
        $raidSix = new RaidSix($drives);
        $this->assertSame(2048, $raidSix->getCapacity());
    }
    public function testGetLevel()
    {
        $raidSix = new RaidSix();
        $this->assertSame(6, $raidSix->getLevel());
    }
}
