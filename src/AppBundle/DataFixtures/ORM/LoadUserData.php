<?php
/**
 * @author Tonny Katongole <tonny.katongole@gmail.com>
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setFirstName('Admin');
        $userAdmin->setOtherNames('Admin');
        $userAdmin->setComicName('Zizinga');
        $userAdmin->setPlainPassword('admin');
        $userAdmin->setEnabled(true);
        $userAdmin->setEmail('admin@zizinga.me');
        $userAdmin->addRole('ROLE_ADMIN');
        $manager->persist($userAdmin);
        $manager->flush();
    }
}