<?php
/**
 * Author: Rottenwood
 * Date Created: 06.09.14 2:14
 */

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wheat
 * @ORM\Table(name="wheat")
 * @ORM\Entity(repositoryClass="Rottenwood\BarchartBundle\Entity\PriceRepository")
 */
class Wheat extends Price {

}
