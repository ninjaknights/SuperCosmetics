<?php

namespace ninjaknights\SuperCosmetics\listeners;

use ninjaknights\SuperCosmetics\forms\MainForm;
use ninjaknights\SuperCosmetics\util\skin\SkinUtil;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\VanillaItems;

class EventListener implements Listener
{

    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        $item = VanillaItems::NETHER_STAR();
        $item->setCustomName("Cosmetics");
        $player->getInventory()->setItem(4, $item);

        $name = $player->getName();
        $skin = $player->getSkin();
        SkinUtil::saveSkin($skin, $name);
    }

    public function onInteract(PlayerInteractEvent $event): void
    {
        $player = $event->getPlayer();
        $name = $player->getInventory()->getItemInHand()->getCustomName();//Item Name

        if ($name === "Cosmetics") (new MainForm)->menuForm($player);
    }

}