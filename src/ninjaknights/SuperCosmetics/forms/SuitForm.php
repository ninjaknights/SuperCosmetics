<?php

namespace ninjaknights\SuperCosmetics\forms;

use ninjaknights\SuperCosmetics\Main;
use ninjaknights\SuperCosmetics\util\skin\SkinUtil;
use pocketmine\player\Player;
use Vecnavium\FormsUI\SimpleForm;

class SuitForm
{

    public function suitForm(Player $player)
    {
        $main = Main::getInstance();
        $form = new SimpleForm(function (Player $player, int $data = null) use ($main) {
            $result = $data;
            if ($result === null) {
                return;
            }
            $suitNames = $main->skinTypes[2];
            $numOfSuits = count($main->skinNames[$suitNames]);
            if($result == $numOfSuits){
                $this->resetSkin($player);
            } elseif ($result == $numOfSuits + 1){
                (new MainForm)->menuForm($player);
            } else {
                $setSkin = new SkinUtil();
                $setSkin->setSkin($player, $main->skinNames[$suitNames][$result], $main->skinTypes[2]);
            }
        });
        $suitNames = $main->skinTypes[2];
        $form->setTitle("Suits");
        $form->setContent("Pick a Suit");
        foreach ($main->skinNames[$suitNames] as $name) {
            $suitName = ucfirst($name);
            $form->addButton($suitName, 0);
        }
        $form->addButton("Reset Skin", 0);
        $form->addButton("Back", 0);
        $player->sendForm($form);
    }

    public function resetSkin(Player $player)
    {
        $reset = new SkinUtil();
        $reset->setDefaultSkin($player);
    }
}