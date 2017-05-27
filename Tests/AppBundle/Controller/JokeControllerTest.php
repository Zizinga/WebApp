<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Constraints\DateTime;

class JokeControllerTest extends WebTestCase
{
    
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/jokes');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /jokes");
        $crawler = $client->click($crawler->selectLink('Post A Joke')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Submit')->form(array(
            'appbundle_joke[content]'  => 'Test',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Should show a validation error like '....field is required....'
        $this->assertGreaterThan(0, $crawler->filter('span:contains("Required")')->count(), 'Missing element span:contains("Required")');

        //Modify the entry

        $form = $crawler->selectButton('Submit')->form(array(
            'appbundle_joke[content]'  => 'Test',
            'appbundle_joke[author]'  => $this->getUser(),
            'appbundle_joke[date]'  => new DateTime('now'),
            'appbundle_joke[status]'  => true,

        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Test"]')->count(), 'Missing element [value="Test"]');

        
    }

    
}
