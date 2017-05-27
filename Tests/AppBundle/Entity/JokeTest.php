<?php
/**
 * @author Tonny Katongole <tonny.katongole@gmail.com>
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Joke;
use PHPUnit\Framework\TestCase;

class JokeTest extends TestCase
{
    public function testContent()
    {
        $joke=new Joke();
        $this->assertNull($joke->getContent());

        $joke->setContent('Sample Content');
        $this->assertEquals('Sample Content', $joke->getContent());
    }

    public function testDate()
    {
        $joke=new Joke();
        $this->assertNull($joke->getDate());
        $date = new DateTime();
        $date->setDate(2001, 2, 3);
        $joke->setDate($date);
        $this->assertEquals($date, $joke->getDate());
    }
    public function testStatus()
    {
        $joke=new Joke();
        $this->assertFalse($joke->getStatus());

        $joke->setStatus(true);
        $this->assertTrue( $joke->getStatus());
    }

    public function testAuthor()
    {
        $joke=new Joke();
        $this->assertNull($joke->getAuthor());
        $user = $this->getUser();
        $joke->setAuthor($user);
        $this->assertEquals($user, $joke->getAuthor());
    }

}