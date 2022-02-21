<?php

namespace ninjaknights\SuperCosmetics\cosmetics\particles;

use ninjaknights\SuperCosmetics\Main;
use ninjaknights\SuperCosmetics\cosmetics\particles\generic\EvaporationParticle;
use ninjaknights\SuperCosmetics\cosmetics\particles\generic\WaterSplashParticle;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;

class RainCloud extends Task
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
                $a = cos(deg2rad($this->count / 0.04)) * 0.5;
                $b = sin(deg2rad($this->count / 0.04)) * 0.5;
                $c = cos(deg2rad($this->count / 0.04)) * 0.8;
                $d = sin(deg2rad($this->count / 0.04)) * 0.8;
                $player->getWorld()->addParticle(new Vector3($x - $a, $y + 3, $z - $b), new EvaporationParticle());
                $player->getWorld()->addParticle(new Vector3($x - $b, $y + 3, $z - $a), new EvaporationParticle());

                $player->getWorld()->addParticle(new Vector3($x - $a, $y + 2.3, $z - $b), new WaterSplashParticle());
                $player->getWorld()->addParticle(new Vector3($x - $b, $y + 2.3, $z - $a), new WaterSplashParticle());

                $player->getWorld()->addParticle(new Vector3($x + $c, $y + 3, $z + $d), new EvaporationParticle());
                $player->getWorld()->addParticle(new Vector3($x + $c, $y + 3, $z + $d), new EvaporationParticle());

                $player->getWorld()->addParticle(new Vector3($x, $y + 3, $z), new EvaporationParticle());
                $player->getWorld()->addParticle(new Vector3($x, $y + 2.3, $z), new WaterSplashParticle());
            }
        }
    }
}