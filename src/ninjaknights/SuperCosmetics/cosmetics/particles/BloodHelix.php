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
                if ($this->count < 0) {
                    $this->count++;
                    return;
                }
                $time = microtime(true) - $this->plugin->getServer()->getStartTime();
                $seconds = floor($time % 14);
                $size = $seconds / 10;
                $a = cos(deg2rad($this->count / 0.04)) * $size;
                $b = sin(deg2rad($this->count / 0.04)) * $size;

                $t = microtime(true) - $this->plugin->getServer()->getStartTime();
                $s = floor($t % 14);
                $c = $s / 5;
                $player->getWorld()->addParticle(new Vector3($x - $a, $y - $c + 2.8, $z - $b), new RedstoneParticle());
                $player->getWorld()->addParticle(new Vector3($x + $a, $y - $c + 2.8, $z + $b), new RedstoneParticle());
                $player->getWorld()->addParticle(new Vector3($x - $b, $y - $c + 2.8, $z + $a), new RedstoneParticle());
                $player->getWorld()->addParticle(new Vector3($x + $b, $y - $c + 2.8, $z - $a), new RedstoneParticle());
                $this->count++;
            }
        }
    }
}
