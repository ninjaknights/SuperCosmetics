<?php

namespace ninjaknights\SuperCosmetics\forms;

use ninjaknights\SuperCosmetics\Main;
use ninjaknights\SuperCosmetics\util\skin\SkinUtil;
use pocketmine\player\Player;
use Vecnavium\FormsUI\SimpleForm;

class HatForm
{

    public function hatForm(Player $player)
    {
        $main = Main::getInstance();
        $form = new SimpleForm(function (Player $player, int $data = null) use ($main) {
            $result = $data;
            if ($result === null) {
                return;
            }
            $hatNames = $main->skinTypes[0];
            $numOfHats = count($main->skinNames[$hatNames]);
            if($result == $numOfHats){
                $this->resetSkin($player);
            } elseif ($result == $numOfHats + 1){
                (new MainForm)->menuForm($player);
            } else {
                $setSkin = new SkinUtil();
                $setSkin->setSkinOnTop($player, $main->skinNames[$hatNames][$result], $main->skinTypes[0]);
            }
        });
        $hatNames = $main->skinTypes[0];
        $form->setTitle("Hats");
        $form->setContent("Pick a Hat");
        foreach ($main->skinNames[$hatNames] as $name) {
            $hatName = ucfirst($name);
            $form->addButton($hatName, 0);
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