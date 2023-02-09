<?php
namespace behzadsp\Raid\Raid;

use Cake\I18n\Number;
use behzadsp\Raid\AbstractRaid;
use behzadsp\Raid\Drive;

class RaidFive extends AbstractRaid
{
    const LEVEL = 5;
    protected $drives = [];
    protected $hotSpares = [];
    protected $minimumDrives = 3;
    protected $mirrored = false;
    protected $parity = true;
    protected $striped = true;

    /**
     * Constructor.
     *
     * @param array $drives An array of \behzadsp\Raid\Drive objects to initialize the RAID with.
     */
    public function __construct(array $drives = [])
    {
        if (empty($drives) === false) {
            $this->validate($drives);
        }

        $this->setDrives($drives);
    }

    /**
     * Get Capacity
     *
     * Options:
     *
     * ```
     * - human - Whether to return the results in human readable format.
     * ```
     * @param array $options Additional options to pass.
     * @return int|string Usable capacity of the RAID in bytes or human readable format.
     */
    public function getCapacity(array $options = [])
    {
        $options += [
            'human' => false,
        ];
        $total = $this->getTotalCapacity();
        $min = $this->getMinimumDriveSize();
        $result = $total === 0 ? $total : ($total - $min);

        if ($options['human'] === true) {
            return Number::toReadableSize($result);
        }

        return $result;
    }
}
