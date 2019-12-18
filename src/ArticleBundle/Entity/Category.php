<?php

namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="ArticleBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="nameOfCategory", type="string", length=90)
     */
    private $nameOfCategory;


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
     * Set nameOfCategory
     *
     * @param string $nameOfCategory
     *
     * @return Category
     */
    public function setNameOfCategory($nameOfCategory)
    {
        $this->nameOfCategory = $nameOfCategory;

        return $this;
    }

    /**
     * Get nameOfCategory
     *
     * @return string
     */
    public function getNameOfCategory()
    {
        return $this->nameOfCategory;
    }
}

