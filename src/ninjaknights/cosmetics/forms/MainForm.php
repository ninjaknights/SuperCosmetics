<?php 

namespace ninjaknights\cosmetics\forms;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class MainForm {
    
    public function menuForm($player) {
        $form = new SimpleForm(function (Player $player, $data) {
        $result = $data;
            if($result === null) {
                return true;
            }
            switch($result) {
                case 0:
                    (new ParticleForm)->particleForm($player);
                break;
            }
        });
           
        $form->setTitle("Cosmetics");
        $form->addButton("Particles",0,"",0);
        $form->sendToPlayer($player);
    }

}