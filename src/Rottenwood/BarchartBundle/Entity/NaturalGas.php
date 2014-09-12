<?php
/**
 * Author: Rottenwood
 * Date Created: 06.09.14 2:14
 */

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NaturalGas
 * @ORM\Table(name="naturalgas")
 * @ORM\Entity(repositoryClass="Rottenwood\BarchartBundle\Repository\PriceRepository")
 */
class NaturalGas extends Price {

}
