<?php

namespace ninjaknights\SuperCosmetics\forms;

use ninjaknights\SuperCosmetics\Main;
use ninjaknights\SuperCosmetics\util\skin\SkinUtil;
use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;

class MorphForm
{

    public function morphForm(Player $player)
    {
        $main = Main::getInstance();
        $form = new SimpleForm(function (Player $player, int $data = null) use ($main) {
            $result = $data;
            if ($result === null) {
                return;
            }
            $morphNames = $main->skinTypes[1];
            $numOfMorphs = count($main->skinNames[$morphNames]);
            if($result == $numOfMorphs){
                $this->resetSkin($player);
            } elseif ($result == $numOfMorphs + 1){
                (new MainForm)->menuForm($player);
            } else {
                $setSkin = new SkinUtil();
                $setSkin->setSkin($player, $main->skinNames[$morphNames][$result], $main->skinTypes[1]);
            }
        });
        $morphNames = $main->skinTypes[1];
        $form->setTitle("Morphs");
        $form->setContent("Pick a Mob");
        foreach ($main->skinNames[$morphNames] as $name) {
            $morphName = ucfirst($name);
            $form->addButton($morphName, 0);
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
