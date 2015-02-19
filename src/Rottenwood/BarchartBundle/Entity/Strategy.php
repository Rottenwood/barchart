<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Стратегии
 * @ORM\Table(name="strategies")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Strategy extends Symbol {

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Analitic", inversedBy="strategies")
     */
    private $author;

    /**
     * @Assert\Count(min=1, minMessage="У стратегии должен быть создан хотя бы один сигнал!")
     * @ORM\ManyToMany(targetEntity="Signal", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinTable(name="strategies_signals",
     *      joinColumns={@ORM\JoinColumn()},
     *      inverseJoinColumns={@ORM\JoinColumn()}
     *      )
     **/
    private $signals;

    /**
     * @var int
     * @ORM\Column(name="symbol", type="smallint")
     */
    private $symbol;

    /**
     * @var bool
     * @ORM\Column(name="is_private", type="boolean")
     */
    private $isPrivate;

    /**
     * Открывать ли новые сделки если уже есть открытая
     * @var bool
     * @ORM\Column(name="open_if_exist", type="boolean")
     */
    private $openIfExist;

//    /**
//     * Процентный расчет лота при открытии сделки
//     * @var bool
//     * @ORM\Column(name="complex_percent", type="boolean")
//     */
//    private $complexPercent;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="update_at", type="datetime", nullable=true)
     */
    private $updatedAt;


    public function __construct() {
        $this->signals = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersistCallback() {
        $this->setCreatedAt(new \Datetime());
        $this->setUpdatedAt(new \Datetime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdateCallback() {
        $this->setUpdatedAt(new \Datetime());
    }

    /**
     * Get id
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    public function __toString() {
        return $this->getName();
    }

    /**
     * Set name
     * @param string $name
     * @return Strategy
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set author
     * @param Analitic $author
     * @return Strategy
     */
    public function setAuthor($author) {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     * @return Analitic
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Set signals
     * @param Signal[] $signals
     * @return Strategy
     */
    public function setSignals($signals) {
        $this->signals = $signals;

        return $this;
    }

    /**
     * Get signals
     * @return Signal[]
     */
    public function getSignals() {
        return $this->signals;
    }

    /**
     * @return int
     */
    public function getSymbol() {
        return $this->symbol;
    }

    /**
     * @param int $symbol
     */
    public function setSymbol($symbol) {
        $this->symbol = $symbol;
    }

    /**
     * @return boolean
     */
    public function isPrivate() {
        return $this->isPrivate;
    }

    /**
     * @param boolean $isPrivate
     */
    public function setIsPrivate($isPrivate) {
        $this->isPrivate = $isPrivate;
    }

    /**
     * @return boolean
     */
    public function openIfExist() {
        return $this->openIfExist;
    }

    /**
     * @param boolean $openIfExist
     */
    public function setOpenIfExist($openIfExist) {
        $this->openIfExist = $openIfExist;
    }

    /**
     * @return boolean
     */
    public function isComplexPercent() {
        return $this->complexPercent;
    }

    /**
     * @param boolean $complexPercent
     */
    public function setComplexPercent($complexPercent) {
        $this->complexPercent = $complexPercent;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }
}
