<?php

namespace ninjaknights\cosmetics\particles;

use ninjaknights\cosmetics\Main;
use pocketmine\color\Color;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\world\particle\DustParticle;

class BlizzardAura extends Task
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
                $size = 0.6;
                $a = cos(deg2rad($this->count / 0.06)) * $size;
                $b = sin(deg2rad($this->count / 0.06)) * $size;

                $player->getWorld()->addParticle(new Vector3($x - $a, $y + 2, $z - $b), new DustParticle(new Color(255, 250, 250, 250)));
                $player->getWorld()->addParticle(new Vector3($x + $a, $y + 2, $z + $b), new DustParticle(new Color(255, 250, 250, 250)));
                $this->count++;
            }
        }
    }
}