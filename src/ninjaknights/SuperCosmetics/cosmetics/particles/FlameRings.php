<?php

namespace ninjaknights\SuperCosmetics\cosmetics\particles;

use ninjaknights\SuperCosmetics\Main;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\world\particle\FlameParticle;

class FlameRings extends Task
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
                $size = 0.8;
                $a = cos(deg2rad($this->count / 0.04)) * $size;
                $b = sin(deg2rad($this->count / 0.04)) * $size;
                $c = cos(deg2rad($this->count / 0.04)) * 0.6;
                $d = sin(deg2rad($this->count / 0.04)) * 0.6;
                $player->getWorld()->addParticle(new Vector3($x + $a, $y + $c + $d + 1.2, $z + $b), new FlameParticle());
                $player->getWorld()->addParticle(new Vector3($x - $b, $y + $c + $d + 1.2, $z - $a), new FlameParticle());
                $this->count++;
            }
        }
    }
}