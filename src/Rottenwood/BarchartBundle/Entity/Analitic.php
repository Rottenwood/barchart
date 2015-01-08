<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Аналитики (юзеры)
 * @ORM\Table(name="analitics")
 * @ORM\Entity
 */
class Analitic extends BaseUser {

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Strategy")
     **/
    protected $strategies;

    /**
     * Get id
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set email
     * @param string $email
     * @return Analitic
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set strategies
     * @param Strategy[] $strategies
     * @return Analitic
     */
    public function setStrategies($strategies) {
        $this->strategies = $strategies;

        return $this;
    }

    /**
     * Get strategies
     * @return Strategy[]
     */
    public function getStrategies() {
        return $this->strategies;
    }
}
