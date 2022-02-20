<?php

namespace ninjaknights\cosmetics\particles\generic;

use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\types\ParticleIds;
use pocketmine\world\particle\Particle;

class WaterSplashParticle implements Particle
{

    /**
     * @inheritDoc
     */
    public function encode(Vector3 $pos): array
    {
        return [LevelEventPacket::standardParticle(ParticleIds::WATER_SPLASH, 0, $pos)];

    }
}