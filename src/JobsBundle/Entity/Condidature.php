<?php

namespace JobsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Condidature
 *
 * @ORM\Table(name="condidature")
 * @ORM\Entity(repositoryClass="JobsBundle\Repository\CondidatureRepository")
 * @Vich\Uploadable
 */
class Condidature
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
     * @ORM\Column(type="string", length=4000)
     */
    private $lettreDeMotivation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cv;
     /**
     * @Vich\UploadableField(mapping="cv_file", fileNameProperty="cv")
     * @var File
     */
    private $cvFile;
   /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;


    /**
     * @ORM\ManyToOne(targetEntity="\JobsBundle\Entity\OffreTravail", inversedBy="condidatures")
     * @ORM\JoinColumn(name="offreTravail", referencedColumnName="id")
     */
    private $offreTravail;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="condidatures")
     * @ORM\JoinColumn(name="condidat", referencedColumnName="id")
     */
    private $condidat;


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
     * Set lettreDeMotivation
     *
     * @param string $lettreDeMotivation
     *
     * @return Condidature
     */
    public function setLettreDeMotivation($lettreDeMotivation)
    {
        $this->lettreDeMotivation = $lettreDeMotivation;

        return $this;
    }

    /**
     * Get lettreDeMotivation
     *
     * @return string
     */
    public function getLettreDeMotivation()
    {
        return $this->lettreDeMotivation;
    }

    /**
     * Set cv
     *
     * @param string $cv
     *
     * @return Condidature
     */
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }

   

    /**
     * Set offreTravail
     *
     * @param integer $offreTravail
     *
     * @return Condidature
     */
    public function setOffreTravail($offreTravail)
    {
        $this->offreTravail = $offreTravail;

        return $this;
    }

    /**
     * Get idOffreTravail
     *
     * @return int
     */
    public function getOffreTravail()
    {
        return $this->offreTravail;
    }


    public function getCvFile(): ?File
    {
        return $this->cvFile;
    }

    public function setcvFile(File $cv = null)
    {
        $this->cvFile = $cv;

     
        if ($cv) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * Get the value of updatedAt
     *
     * @return  \DateTime
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @param  \DateTime  $updatedAt
     *
     * @return  self
     */ 
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


    /**
     * Set condidat
     *
     * @param \UserBundle\Entity\User $condidat
     *
     * @return Condidature
     */
    public function setCondidat(\UserBundle\Entity\User $condidat = null)
    {
        $this->condidat = $condidat;

        return $this;
    }

    /**
     * Get condidat
     *
     * @return \UserBundle\Entity\User
     */
    public function getCondidat()
    {
        return $this->condidat;
    }
}
