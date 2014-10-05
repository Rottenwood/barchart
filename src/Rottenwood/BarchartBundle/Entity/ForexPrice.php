<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forex Price
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="openinterest",
 *          column=@ORM\Column(
 *              name     = "averagevolume",
 *              type     = "integer"
 *          )
 *      )
 * })
 */
abstract class ForexPrice extends Price {

    private $openinterest;
}
