<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Etape
 *
 * @ORM\Table(name="etape")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EtapeRepository")
 */
class Etape
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
     * @var string
     *
     * @ORM\Column(name="nomEtape", type="string", length=255)
     */
    private $nomEtape;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="string", length=255)
     */
    private $duree;

   /**
     * @Gedmo\Slug(fields={"nomEtape"})
     * @ORM\Column(length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="quoiObtenir", type="string", length=255)
     */
    private $quoiObtenir;

    /**
     * @var int
     *
     * @ORM\Column(name="cout", type="string")
     */
    private $cout;


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
     * Set nomEtape
     *
     * @param string $nomEtape
     *
     * @return Etape
     */
    public function setNomEtape($nomEtape)
    {
        $this->nomEtape = $nomEtape;

        return $this;
    }

    /**
     * Get nomEtape
     *
     * @return string
     */
    public function getNomEtape()
    {
        return $this->nomEtape;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Etape
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set duree
     *
     * @param string $duree
     *
     * @return Etape
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set quoiObtenir
     *
     * @param string $quoiObtenir
     *
     * @return Etape
     */
    public function setQuoiObtenir($quoiObtenir)
    {
        $this->quoiObtenir = $quoiObtenir;

        return $this;
    }

    /**
     * Get quoiObtenir
     *
     * @return string
     */
    public function getQuoiObtenir()
    {
        return $this->quoiObtenir;
    }

    /**
     * Set cout
     *
     * @param integer $cout
     *
     * @return Etape
     */
    public function setCout($cout)
    {
        $this->cout = $cout;

        return $this;
    }

    /**
     * Get cout
     *
     * @return int
     */
    public function getCout()
    {
        return $this->cout;
    }
    public function getSlug(){
        return $this->slug;
    }
    public function setSlug($slug){
        $this->slug=$slug;
        return $this;
    }
}

