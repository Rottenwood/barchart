<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * USDCAD
 * @ORM\Table(name="USDCAD")
 * @ORM\Entity(repositoryClass="Rottenwood\BarchartBundle\Repository\PriceRepository")
 */
class USDCAD extends Price {

}
