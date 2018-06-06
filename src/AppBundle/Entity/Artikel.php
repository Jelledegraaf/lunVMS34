<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Artikel
 *
 * @ORM\Table(name="artikel")
 * @ORM\Entity
 */
class Artikel
{
  /**
   * @var integer
   *
   * @ORM\Column(name="artikelnummer", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $artikelnummer;

    /**
     * @var string
     *
     * @ORM\Column(name="omschrijving", type="string", length=255, nullable=false)
     */
    private $omschrijving;

    /**
     * @var string
     *
     * @ORM\Column(name="technischespecificaties", type="string", length=255, nullable=false)
     */
    private $technischeSpecificaties;

  /**
    * @var string
    *
    * @ORM\Column(name="magazijnlocatie", type="string", length=6, nullable=false)
    * @Assert\Regex(
    *    pattern = "/^20|[0-1]{1}[0-9]{1}\/[A-Z][0]{1}[0-9]{1}|10$/i",
    *    match=true,
    *    message="Ongeldige locatie [ERROR1]")
    * @Assert\Regex(
    *    pattern = "/^[2]{1}[1-9]{1}\/[A-Z]{1}[0-9]{1}$/i",
    *    match=false,
    *    message="Ongeldige locatie [ERROR2]")
    * @Assert\Regex(
    *    pattern = "/^[3-9]{1}[0-9]{1}\/[A-Z][0-9]{1}$/i",
    *    match=false,
    *    message="Ongeldige locatie [ERROR3]")
    * @Assert\Regex(
    *    pattern = "/^[0-1]{1}[0-9]{1}\/[A-Z][1]{1}[1-9]{1}$/i",
    *    match=false,
    *    message="Ongeldige locatie [ERROR4]")
    * @Assert\Regex(
    *    pattern = "/^[0-1]{1}[0-9]{1}\/[A-Z][2-9]{1}[0-9]{1}$/i",
    *    match=false,
    *    message="Ongeldige locatie [ERROR5]")
    * @Assert\Regex(
    *    pattern = "/^[0-9A-Za-z]+$/i",
    *    match=false,
    *    message="Ongeldige locatie [ERROR6]")
    * @Assert\Length(
    *      max = 6,
    *      maxMessage = "Mag niet meer zijn dan {{ limit }} karakters"
    * )
     */
    private $magazijnlocatie;

    /**
     * @var string
     *
     * @ORM\Column(name="inkoopprijs", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $inkoopprijs;

    /**
     * @var integer
     *
     * @ORM\Column(name="artikelnummervervanging", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="Artikel", mappedBy="artikelnummerVervanging")
     */
    private $artikelnummerVervanging;

    /**
     * @var integer
     *
     * @ORM\Column(name="minimumvoorraad", type="integer", nullable=false)
     */
    private $minimumVoorraad;

    /**
     * @var string
     *
     * @ORM\Column(name="voorraad", type="string", length=100, nullable=true)
     */
    private $voorraad;

    /**
     * @var integer
     *
     * @ORM\Column(name="bestelserie", type="integer", nullable=true)
     */
    private $bestelserie;

    /**
     * @ORM\OneToMany(targetEntity="Bestelregel", mappedBy="artikelnummer")
     */
    private $bestelregels;


    public function getArtikelnummer(){
		return $this->artikelnummer;
	}

	public function setArtikelnummer($artikelnummer){
		$this->artikelnummer = $artikelnummer;
	}

	public function getOmschrijving(){
		return $this->omschrijving;
	}

	public function setOmschrijving($omschrijving){
		$this->omschrijving = $omschrijving;
	}

	public function getTechnischeSpecificaties(){
		return $this->technischeSpecificaties;
	}

	public function setTechnischeSpecificaties($technischeSpecificaties){
		$this->technischeSpecificaties = $technischeSpecificaties;
	}

	public function getMagazijnlocatie(){
		return $this->magazijnlocatie;
	}

	public function setMagazijnlocatie($magazijnlocatie){
		$this->magazijnlocatie = $magazijnlocatie;
	}

	public function getInkoopprijs(){
		return $this->inkoopprijs;
	}

	public function setInkoopprijs($inkoopprijs){
		$this->inkoopprijs = $inkoopprijs;
	}

	public function getArtikelnummerVervanging(){
		return $this->artikelnummerVervanging;
	}

	public function setArtikelnummerVervanging($artikelnummerVervanging){
		$this->artikelnummerVervanging = $artikelnummerVervanging;
	}

	public function getMinimumVoorraad(){
		return $this->minimumVoorraad;
	}

	public function setMinimumVoorraad($minimumVoorraad){
		$this->minimumVoorraad = $minimumVoorraad;
	}

	public function getVoorraad(){
		return $this->voorraad;
	}

	public function setVoorraad($voorraad){
		$this->voorraad = $voorraad;
	}

	public function getBestelserie(){
		return $this->bestelserie;
	}

	public function setBestelserie($bestelserie){
		$this->bestelserie = $bestelserie;
	}

  public function __construct()
  {
    $this->bestelregels = new ArrayCollection();
  }

  public function __toString() {
  return "$this->artikelnummer";
  }

}
