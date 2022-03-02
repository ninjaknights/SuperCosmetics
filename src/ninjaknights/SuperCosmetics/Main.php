<?php

namespace ninjaknights\SuperCosmetics;

use ninjaknights\SuperCosmetics\listeners\EventListener;
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

        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        foreach (["steve.png", "steve.json"] as $file) {
            $this->saveResource($file);
        }
        foreach (["zombie", "creeper"] as $morphs) {
            $this->saveResource("skins/morphs/" . $morphs . ".png");
            $this->saveResource("skins/morphs/" . $morphs . ".json");
        }
        foreach (["spacesuit", "alien", "frog"] as $suits) {
            $this->saveResource("skins/suits/" . $suits . ".png");
            $this->saveResource("skins/suits/" . $suits . ".json");
        }
        foreach (["tv", "melon", "cowboy", "crown", "top", "glass", "pumpkin", "witch"] as $hats) {
            $this->saveResource("skins/hats/" . $hats . ".png");
            $this->saveResource("skins/hats/" . $hats . ".json");
        }
        $skin = new SkinUtil();
        $skin->getSkins();
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