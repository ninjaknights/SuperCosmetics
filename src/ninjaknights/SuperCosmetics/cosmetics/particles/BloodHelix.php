<?php

namespace ninjaknights\SuperCosmetics\cosmetics\particles;

use ninjaknights\SuperCosmetics\Main;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\world\particle\RedstoneParticle;

class BloodHelix extends Task
{
    private Main $plugin;
    private int $count = 0;

    public function __construct(Main $caller)
    {
        $this->plugin = $caller;
    }

    /**
     * @inheritDoc
     */
    public function onRun(): void
    {
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
            if ($this->plugin->hasEnabledParticle($player)) {
                $x = $player->getPosition()->getX();
                $y = $player->getPosition()->getY();
                $z = $player->getPosition()->getZ();

                $size = 1;
                $a = cos(deg2rad($this->count / 0.09)) * $size;
                $b = sin(deg2rad($this->count / 0.09)) * $size;
                $c = sin(deg2rad($this->count / 0.2)) * $size;
                $player->getWorld()->addParticle(new Vector3($x - $a, $y + 2, $z - $b), new RedstoneParticle());

                $this->count++;
            }
        }
    }
}
