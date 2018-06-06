<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * bestelopdracht
 *
 * @ORM\Table(name="bestelopdracht")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BestelopdrachtRepository")
 */
class Bestelopdracht
{
    /**
     * @var string
     *
     * @ORM\Column(name="NaamLeverancier", type="text")
     */
    private $naamLeverancier;

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="bestelordernummer", type="integer", unique=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $bestelordernummer;

    /**
     * @ORM\OneToMany(targetEntity="Bestelregel", mappedBy="bestelordernummer")
     */
    private $bestelregels;

    /**
     * Set bestelregels
     *
     */
    public function setBestelregels($bestelregels)
    {
        $this->bestelregels = $bestelregels;

        return $this;
    }

    /**
     * Get bestelregels
     *
     * @return int
     */
    public function getBestelregels()
    {
        return $this->bestelregels;
    }

    /**
     * Set naamLeverancier
     *
     * @param string $naamLeverancier
     *
     * @return Bestelopdracht
     */
    public function setNaamLeverancier($naamLeverancier)
    {
        $this->naamLeverancier = $naamLeverancier;

        return $this;
    }

    /**
     * Get naamLeverancier
     *
     * @return string
     */
    public function getNaamLeverancier()
    {
        return $this->naamLeverancier;
    }

    /**
     * Get bestelordernummer
     *
     * @return int
     */
    public function getBestelordernummer()
    {
        return $this->bestelordernummer;
    }


    public function __toString() {
  return "$this->bestelordernummer";
  }

  public function __construct()
  {
    $this->bestelregels = new ArrayCollection();
  }
}
