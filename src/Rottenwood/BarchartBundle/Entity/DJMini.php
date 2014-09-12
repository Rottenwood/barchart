<?php
/**
 * Author: Rottenwood
 * Date Created: 06.09.14 2:14
 */

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DJMini
 * @ORM\Table(name="djmini")
 * @ORM\Entity(repositoryClass="Rottenwood\BarchartBundle\Repository\PriceRepository")
 */
class DJMini extends Price {

}
