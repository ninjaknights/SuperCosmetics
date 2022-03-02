<?php

namespace ninjaknights\SuperCosmetics\forms;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class MainForm
{

    public function menuForm(Player $player)
    {
        $form = new SimpleForm(function (Player $player, $data) {
            $result = $data;
            if ($result === null) {
                return;
            }
            switch ($result) {
                case 0:
                    (new ParticleForm)->particleForm($player);
                    break;
                case 1:
                    (new SuitForm)->suitForm($player);
                    break;
                case 2:
                    (new HatForm)->hatForm($player);
                    break;
                case 3:
                    (new MorphForm())->morphForm($player);
                    break;
            }
        });

        $form->setTitle("Cosmetics");
        $form->addButton("Particles", 0, "", 0);
        $form->addButton("Suits", 0, "", 1);
        $form->addButton("Hats", 0, "", 2);
        $form->addButton("Morphs", 0, "", 3);
        $form->addButton("Pets", 0, "", 4);
        $form->addButton("Gadgets", 0, "", 5);
        $player->sendForm($form);
    }

}