<?php
/**
 * Created by PhpStorm.
 * User: kanat
 * Date: 3/5/16
 * Time: 5:52 PM
 */
namespace Blog\ModelBundle\DataFixtures\ORM;
use Blog\ModelBundle\Entity\Author;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
/**
 * Fixtures for the Author Entity
 *
 */
class Authors extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc }
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $a1 = new Author();
        $a1->setName('Kanat');
        $a2 = new Author();
        $a2-> setName('Marat');
        $a3 = new Author();
        $a3-> setName('Murat');
        $manager->persist($a1);
        $manager->persist($a2);
        $manager->persist($a3);
        $manager->flush();
    }
}