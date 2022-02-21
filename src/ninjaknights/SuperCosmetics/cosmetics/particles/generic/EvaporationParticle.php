<?php

namespace ninjaknights\SuperCosmetics\cosmetics\particles\generic;

use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\types\ParticleIds;
use pocketmine\world\particle\Particle;

class EvaporationParticle implements Particle
{

    /**
     * @inheritDoc
     */
    public function encode(Vector3 $pos): array
    {
        return [LevelEventPacket::standardParticle(ParticleIds::EVAPORATION, 0, $pos)];
    }
}