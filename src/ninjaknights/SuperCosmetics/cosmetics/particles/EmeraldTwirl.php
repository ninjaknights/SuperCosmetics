<?php

namespace ninjaknights\cosmetics\particles;


use ninjaknights\cosmetics\Main;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\world\particle\HappyVillagerParticle;

class EmeraldTwirl extends Task
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
                //count is never reduced and initialized at 0 why would we check that?
                if ($this->count < 0) {
                    $this->count++;
                    return;
                }
                $size = 1;
                $a = cos(deg2rad($this->count / 0.09)) * $size;
                $b = sin(deg2rad($this->count / 0.09)) * $size;
                $c = sin(deg2rad($this->count / 0.2)) * $size;
                $player->getWorld()->addParticle(new Vector3($x - $a, $y + $c + 1.4, $z - $b), new HappyVillagerParticle());
                $this->count++;
            }
        }
    }
}