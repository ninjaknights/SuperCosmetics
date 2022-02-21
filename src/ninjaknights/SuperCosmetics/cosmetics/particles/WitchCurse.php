<?php

namespace ninjaknights\SuperCosmetics\cosmetics\particles;

use ninjaknights\SuperCosmetics\Main;
use ninjaknights\SuperCosmetics\cosmetics\particles\generic\WitchSpellParticle;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;

class WitchCurse extends Task
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
                $a = cos($this->count * 0.1) * 1.2;
                $b = sin($this->count * 0.1) * 1.2;
                $player->getWorld()->addParticle(new Vector3($x + $a, $y + 1, $z + $b), new WitchSpellParticle());
                $player->getWorld()->addParticle(new Vector3($x - $a, $y + 1, $z - $b), new WitchSpellParticle());
                $player->getWorld()->addParticle(new Vector3($x + $b, $y + 1, $z - $a), new WitchSpellParticle());
                $player->getWorld()->addParticle(new Vector3($x - $b, $y + 1, $z + $a), new WitchSpellParticle());

                $this->count++;
            }
        }
    }
}