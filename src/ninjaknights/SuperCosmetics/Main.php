<?php

namespace ninjaknights\SuperCosmetics;

use ninjaknights\SuperCosmetics\util\skin\SkinUtil;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{
    private static Main $instance;
    public array $skinTypes = [];
    public array $skinNames = [];

    public function onEnable(): void
    {
        self::$instance = $this;
        $a = new SkinUtil();
        $a->getSkins();

        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        foreach (["steve.png", "steve.json"] as $file) {
            $this->saveResource($file);
        }
        foreach (["spacesuit", "alien", "frog", "youtube"] as $suits) {
            $this->saveResource("skins/suits/" . $suits . ".png");
            $this->saveResource("skins/suits/" . $suits . ".json");
        }
        foreach (["tv", "melon"] as $hats) {
            $this->saveResource("skins/hats/" . $hats . ".png");
            $this->saveResource("skins/hats/" . $hats . ".json");
        }
    }

    // Fake Functions
    // TODO: Use internal API to determine which particles are enabled for who
    public function hasEnabledParticle(Player $player): bool
    {
        return true;
    }

    public static function getInstance() : Main
    {
        return self::$instance;
    }
}