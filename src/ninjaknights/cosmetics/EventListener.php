<?php

namespace ninjaknights\cosmetics;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\VanillaItems;

class EventListener implements Listener
{

    public function onPlayerJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        $item = VanillaItems::NETHER_STAR();
        $item->setCustomName("Cosmetics");
        $player->getInventory()->setItem(4, $item);

    }

    public function onInteract(PlayerInteractEvent $event): void
    {
        $player = $event->getPlayer();
        $name = $player->getInventory()->getItemInHand()->getCustomName();//Item Name

        if ($name === "Cosmetics") (new forms\MainForm)->menuForm($player);
    }

}