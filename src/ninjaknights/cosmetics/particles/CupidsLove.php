<?php

namespace ninjaknights\cosmetics\particles;

use ninjaknights\cosmetics\Main;
use pocketmine\math\Vector3;
use pocketmine\world\particle\HeartParticle;

class CupidsLove extends \pocketmine\scheduler\Task
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
                $size = 1.2;
                $a = cos(deg2rad($this->count / 0.09)) * $size;
                $b = sin(deg2rad($this->count / 0.09)) * $size;
                $c = sin(deg2rad($this->count / 0.2)) * $size;
                $player->getWorld()->addParticle(new Vector3($x - $a, $y + $c + 1.4, $z - $b), new HeartParticle());
                $this->count++;
            }

        }
    }
}