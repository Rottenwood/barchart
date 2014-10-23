<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Аналитики (юзеры)
 *
 * @ORM\Table(name="analitics")
 * @ORM\Entity
 */
class Analitic {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity="Strategy", inversedBy="authors")
     * @ORM\JoinTable()
     **/
    private $strategies;

    public function __construct() {
        $this->strategies = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Analitic
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Analitic
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set strategies
     *
     * @param Strategy[] $strategies
     * @return Analitic
     */
    public function setStrategies($strategies) {
        $this->strategies = $strategies;

        return $this;
    }

    /**
     * Get strategies
     *
     * @return Strategy[]
     */
    public function getStrategies() {
        return $this->strategies;
    }
}
