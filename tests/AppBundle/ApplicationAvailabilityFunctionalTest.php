<?php
/**
 * @author Tonny Katongole <tonny.katongole@gmail.com>
 */

namespace Tests\AppBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * Simple functional test to ensure that atleast the basic routes can be loaded.
     *
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return
            array(array('/'),
                array('joke_index'),
                array('joke_new'),
                array('question_index'),
                array('question_new'),
                array('fos_user_change_password'),
                array('fos_user_registration_register'),
                array('fos_user_resetting_request')
            );
    }
}