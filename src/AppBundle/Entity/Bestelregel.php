<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Bestelregel
 *
 * @ORM\Table(name="bestelregel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BestelregelRepository")
 */
class Bestelregel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Artikel", inversedBy="bestelregels")
     * @ORM\JoinColumn(name="artikelnummer", referencedColumnName="artikelnummer")
     */
    private $artikelnummer;

    /**
     * @ORM\ManyToOne(targetEntity="Bestelopdracht", inversedBy="bestelregels")
     * @ORM\JoinColumn(name="bestelordernummer", referencedColumnName="bestelordernummer")
     */
    private $bestelordernummer;

    /**
     * @var int
     *
     * @ORM\Column(name="aantal", type="integer", nullable=true)
     */
    private $aantal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ontvangstdatum", type="date", nullable=true)
     */
    private $ontvangstdatum;

    /**
     * @var bool
     *
     * @ORM\Column(name="kwaliteit", type="boolean", nullable=true)
     */
    private $kwaliteit;

    /**
     * @var bool
     *
     * @ORM\Column(name="afgekeurd", type="boolean", nullable=true)
     */
    private $afgekeurd;

    /**
     * @var int
     *
     * @ORM\Column(name="ontvangen", type="integer", nullable=true)
     */
    private $ontvangen;

    /**
    * @var string
    *
    * @ORM\Column(name="afkeuringscode", type="string", nullable=true)
    */
    private $afkeuringscode;

     /**
         * Get afkeuringscode
         *
         * @return string
         */
        public function getafkeuringscode()
        {
            return $this->afkeuringscode;
        }

     /**
         * Set afkeuringscode
         *
         * @param string $afkeuringscode
         *
         * @return afkeuringscode
         */
        public function setafkeuringscode($afkeuringscode)
        {
            $this->afkeuringscode = $afkeuringscode;

            return $this;
        }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set artikelnummer
     *
     * @return Bestelregel
     */
    public function setArtikelnummer($artikelnummer)
    {
        $this->artikelnummer = $artikelnummer;

        return $this;
    }

    /**
     * Get artikelnummer
     *
     * @return int
     */
    public function getArtikelnummer()
    {
        return $this->artikelnummer;
    }

    /**
     * Set bestelordernummer
     *
     * @return Bestelregel
     */
    public function setBestelordernummer($bestelordernummer)
    {
        $this->bestelordernummer = $bestelordernummer;

        return $this;
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

    /**
     * Set aantal
     *
     * @param integer $aantal
     *
     * @return Bestelregel
     */
    public function setAantal($aantal)
    {
        $this->aantal = $aantal;

        return $this;
    }

    /**
     * Get aantal
     *
     * @return int
     */
    public function getAantal()
    {
        return $this->aantal;
    }



    /**
     * Set ontvangstdatum
     *
     * @param \DateTime $ontvangstdatum
     *
     * @return Bestelregel
     */
    public function setOntvangstdatum($ontvangstdatum)
    {
        $this->ontvangstdatum = $ontvangstdatum;

        return $this;
    }

    /**
     * Get ontvangstdatum
     *
     * @return \DateTime
     */
    public function getOntvangstdatum()
    {
        return $this->ontvangstdatum;
    }

    /**
     * Set kwaliteit
     *
     * @param boolean $kwaliteit
     *
     * @return Bestelregel
     */
    public function setKwaliteit($kwaliteit)
    {
        $this->kwaliteit = $kwaliteit;

        return $this;
    }

    /**
     * Get kwaliteit
     *
     * @return bool
     */
    public function getKwaliteit()
    {
        return $this->kwaliteit;
    }

    /**
     * Set afgekeurd
     *
     * @param boolean $afgekeurd
     *
     * @return Bestelregel
     */
    public function setAfgekeurd($afgekeurd)
    {
        $this->afgekeurd = $afgekeurd;

        return $this;
    }

    /**
     * Get afgekeurd
     *
     * @return bool
     */
    public function getAfgekeurd()
    {
        return $this->afgekeurd;
    }

    /**
     * Set ontvangen
     *
     * @param integer $ontvangen
     *
     * @return Bestelregel
     */
    public function setOntvangen($ontvangen)
    {
        $this->ontvangen = $ontvangen;

        return $this;
    }

    /**
     * Get ontvangen
     *
     * @return int
     */
    public function getOntvangen()
    {
        return $this->ontvangen;
    }
}
