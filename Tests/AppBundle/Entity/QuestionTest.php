<?php
/**
 * @author Tonny Katongole <tonny.katongole@gmail.com>
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Question;
use PHPUnit\Framework\TestCase;

class JokeTest extends TestCase
{
    public function testContent()
    {
        $question=new Question();
        $this->assertNull($question->getContent());

        $question->setContent('Sample Content');
        $this->assertEquals('Sample Content', $question->getContent());
    }

    public function testDate()
    {
        $question=new Question();
        $this->assertNull($question->getDate());
        $date = new DateTime();
        $date->setDate(2001, 2, 3);
        $question->setDate($date);
        $this->assertEquals($date, $question->getDate());
    }
    public function testEnabled()
    {
        $question=new Question();
        $this->assertFalse($question->getEnabled());

        $question->setEnabled(true);
        $this->assertTrue( $question->getEnabled());
    }

    public function testAuthor()
    {
        $question=new Question();
        $this->assertNull($question->getAuthor());
        $user = $this->getUser();
        $question->setAuthor($user);
        $this->assertEquals($user, $question->getAuthor());
    }

}