<?php
/**
 * Author: Rottenwood
 * Date Created: 06.09.14 2:14
 */

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Corn
 * @ORM\Table(name="corn")
 * @ORM\Entity(repositoryClass="Rottenwood\BarchartBundle\Entity\PriceRepository")
 */
class Corn extends Price {

}
