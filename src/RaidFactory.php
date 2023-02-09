<?php
namespace behzadsp\Raid;

use InvalidArgumentException;
use behzadsp\Raid\Raid\RaidFive;
use behzadsp\Raid\Raid\RaidOne;
use behzadsp\Raid\Raid\RaidSix;
use behzadsp\Raid\Raid\RaidTen;
use behzadsp\Raid\Raid\RaidZero;

class RaidFactory
{
    /**
     * Create
     *
     * @param int $level The RAID level to create.
     * @param mixed $drives A single \behzadsp\Raid\Drive or array of Drive objects.
     * @throws \InvalidArgumentException If the level provided is not supported by this library.
     * @return \behzadsp\Raid\AbstractRaid Initialized Raid object.
     */
    public function create(int $level, $drives)
    {
        $drives = (array)$drives;
        $raid = null;

        switch ($level) {
            case 0:
                $raid = new RaidZero($drives);
                break;
            case 1:
                $raid = new RaidOne($drives);
                break;
            case 5:
                $raid = new RaidFive($drives);
                break;
            case 6:
                $raid = new RaidSix($drives);
                break;
            case 10:
                $raid = new RaidTen($drives);
                break;
        }

        if ($raid === null) {
            throw new InvalidArgumentException('Unsupported RAID level provided. (Supported levels: 0, 1, 5, 6, 10)');
        }

        return $raid;
    }
}
