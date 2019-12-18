<?php

namespace AppBundle\DataFixtures\ORM;

use ArticleBundle\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

class categoriesFixtures implements FixtureInterface
{
    public function load(ObjectManager $objectManager)
    {
        $category1 = new Category();
        $category1->setNameOfCategory('Actualité sur le status en tunisie');
        $objectManager->persist($category1);
        $category2 = new Category();
        $category2->setNameOfCategory('Conseils');
        $objectManager->persist($category2);
        $category3 = new Category();
        $category3->setNameOfCategory('Evénements');
        $objectManager->persist($category3);
        $category4 = new Category();
        $category4->setNameOfCategory('L\'entreprenariat en tunisie');
        $objectManager->persist($category4);
        $objectManager->flush();
    }
}
