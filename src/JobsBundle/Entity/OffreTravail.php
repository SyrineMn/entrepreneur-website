<?php

namespace JobsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * OffreTravail
 *
 * @ORM\Table(name="offre_travail")
 * @ORM\Entity(repositoryClass="JobsBundle\Repository\OffreTravailRepository")
 */
class OffreTravail
{
    
    /**
     * @ORM\OneToMany(targetEntity="JobsBundle\Entity\Condidature", mappedBy="offreTravail")
     */
    private $condidatures;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="condidature", mappedBy="Condidature")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="recruter", type="string", length=100)
     */
    private $recruter;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

   /**
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(type="datetime")
    */
    private $postedAt;
/**
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(type="datetime")
    */
    private $lastUpdatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=100)
     */
    private $location;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="niveauEtudes", type="string", length=100)
     */
    private $niveauEtudes;

    /**
     * @var string
     *
     * @ORM\Column(name="experience", type="string", length=100)
     */
    private $experience;


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
     * Set title
     *
     * @param string $title
     *
     * @return OffreTravail
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return OffreTravail
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set recruter
     *
     * @param string $recruter
     *
     * @return OffreTravail
     */
    public function setRecruter($recruter)
    {
        $this->recruter = $recruter;

        return $this;
    }

    /**
     * Get recruter
     *
     * @return string
     */
    public function getRecruter()
    {
        return $this->recruter;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return OffreTravail
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
     * Set postedAt
     *
     * @param \DateTime $postedAt
     *
     * @return OffreTravail
     */
    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;

        return $this;
    }

    /**
     * Get postedAt
     *
     * @return \DateTime
     */
    public function getPostedAt()
    {
        return $this->postedAt;
    }

    /**
     * Set lastUpdatedAt
     *
     * @param \DateTime $lastUpdatedAt
     *
     * @return OffreTravail
     */
    public function setLastUpdatedAt($lastUpdatedAt)
    {
        $this->lastUpdatedAt = $lastUpdatedAt;

        return $this;
    }

    /**
     * Get lastUpdatedAt
     *
     * @return \DateTime
     */
    public function getLastUpdatedAt()
    {
        return $this->lastUpdatedAt;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return OffreTravail
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return OffreTravail
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set niveauEtudes
     *
     * @param string $niveauEtudes
     *
     * @return OffreTravail
     */
    public function setNiveauEtudes($niveauEtudes)
    {
        $this->niveauEtudes = $niveauEtudes;

        return $this;
    }

    /**
     * Get niveauEtudes
     *
     * @return string
     */
    public function getNiveauEtudes()
    {
        return $this->niveauEtudes;
    }

    /**
     * Set experience
     *
     * @param string $experience
     *
     * @return OffreTravail
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return string
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Get the value of condidatures
     */ 
    public function getCondidatures()
    {
        return $this->condidatures;
    }

    /**
     * Set the value of condidatures
     *
     * @return  self
     */ 
    public function setCondidatures($condidatures)
    {
        $this->condidatures = $condidatures;

        return $this;
    }
}

