<?php
/**
 * Created by PhpStorm.
 * User: kanat
 * Date: 3/5/16
 * Time: 6:06 PM
 */
namespace Blog\ModelBundle\DataFixtures\ORM;
use Blog\ModelBundle\Entity\Author;
use Blog\ModelBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
/**
 * Fixtures for the Post Entity
 *
 */
class Posts extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
     public function getOrder()
     {
         return 15;
     }
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $p1 = new Post();
        $p1->setTitle('Lorem ipsum dolor sit amet');
        $p1->setBody('Phasellus lorem elit, placerat eget neque non, pretium pretium erat. In sit amet efficitur nunc, id dapibus tellus. Vestibulum eget congue ex, nec semper turpis. Nulla quis est nec odio tincidunt aliquam. Curabitur ac ipsum eget enim rhoncus rhoncus. Morbi porttitor mauris nec risus sodales commodo. Aenean blandit eros eget convallis pulvinar. Integer rutrum imperdiet porta. In hac habitasse platea dictumst. Praesent viverra leo metus, ac faucibus justo aliquam sed. Mauris gravida accumsan lectus, ut lacinia ligula pulvinar ac.');
        $p1->setAuthor($this->getAuthor($manager,'Kanat'));

        $p2 = new Post();
        $p2->setTitle('In a pellentesque massa, sed lacinia tellus');
        $p2->setBody('Nunc sit amet viverra massa. Ut dictum pulvinar libero hendrerit iaculis. Donec volutpat vestibulum tempus. Vestibulum facilisis, lacus vitae rutrum ultrices, sem justo laoreet eros, in ullamcorper ipsum nisi eget mi. Donec aliquet dui ut consequat placerat. Duis tempor, enim vitae interdum sagittis, enim eros interdum ligula, eget iaculis ipsum dolor sit amet risus. Ut tincidunt purus eget ante pretium, eget placerat risus varius. Mauris dapibus efficitur velit, sit amet pretium neque pellentesque euismod. Quisque ullamcorper lectus ut ex viverra consequat. Proin molestie massa purus, vel ullamcorper diam ultrices eget. Pellentesque condimentum iaculis arcu volutpat posuere. Donec posuere, ex ut condimentum accumsan, elit lectus pretium tortor, non dignissim arcu tellus quis turpis.');
        $p2->setAuthor($this->getAuthor($manager, 'Murat'));

        $p3 = new Post();
        $p3->setTitle('Vivamus tempor, erat quis bibendum congue, dolor velit lobortis magna');
        $p3->setBody('Curabitur accumsan est nec libero iaculis, in ullamcorper nulla feugiat. In ac nunc sollicitudin libero accumsan elementum in hendrerit diam. Nulla placerat interdum risus, sed venenatis quam scelerisque ac. Praesent hendrerit semper ante a consectetur. Nam aliquet enim at mollis efficitur. Aliquam condimentum fermentum nunc, eu interdum diam fringilla sit amet. Aliquam sodales nisi in ante mollis, quis tempus leo vestibulum.');
        $p3->setAuthor($this->getAuthor($manager, 'Marat'));
        $manager->persist($p1);
        $manager->persist($p2);
        $manager->persist($p3);

        $manager->flush();
    }

    /**
     * Get an author
     * @param ObjectManager $manager
     * @param string        $name
     *
     * @return Author
     */
    private function getAuthor(ObjectManager $manager , $name)
    {
      return $manager->getRepository('ModelBundle:Author')->findOneBy(
          array(
              'name'=>$name
          )
      );
    }
}



