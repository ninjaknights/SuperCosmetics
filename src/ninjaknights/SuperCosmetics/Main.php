<?php

namespace ninjaknights\SuperCosmetics;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }

    // Fake Functions
    // TODO: Use internal API to determine which particles are enabled for who
    public function hasEnabledParticle(Player $player): bool
    {
        return true;
    }

}