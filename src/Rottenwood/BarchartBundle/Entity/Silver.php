<?php
/**
 * Author: Rottenwood
 * Date Created: 06.09.14 2:14
 */

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Silver
 * @ORM\Table(name="silver")
 * @ORM\Entity(repositoryClass="Rottenwood\BarchartBundle\Repository\PriceRepository")
 */
class Silver extends Price {

}
