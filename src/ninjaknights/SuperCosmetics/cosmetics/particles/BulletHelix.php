<?php

namespace ninjaknights\SuperCosmetics\cosmetics\particles;

use ninjaknights\SuperCosmetics\Main;
use ninjaknights\SuperCosmetics\cosmetics\particles\generic\ShulkerBulletParticle;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;

class BulletHelix extends Task
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
                $c = cos(deg2rad($this->count / 0.3)) * $size;
                $player->getWorld()->addParticle(new Vector3($x - $a, $y + $c + 1.4, $z - $b), new ShulkerBulletParticle());
                $player->getWorld()->addParticle(new Vector3($x + $a, $y + $c + 1.4, $z + $b), new ShulkerBulletParticle());
                $this->count++;
            }

        }
    }
}