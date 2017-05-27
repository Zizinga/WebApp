<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JokeShare
 *
 * @ORM\Table(name="joke_share")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JokeShareRepository")
 */
class JokeShare
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    /**
     * @var string
     *
     * @ORM\Column(name="platform", type="string", length=30)
     */
    private $platform;
    
    /**
     * Many shares have one author.
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * Many shares belong to one joke.
     * @ORM\ManyToOne(targetEntity="Joke")
     * @ORM\JoinColumn(name="joke_id", referencedColumnName="id")
     */
    private $joke;

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return JokeShare
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set platform
     *
     * @param string $platform
     *
     * @return JokeShare
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform
     *
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     *
     * @return JokeShare
     */
    public function setAuthor(\AppBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set joke
     *
     * @param \AppBundle\Entity\Joke $joke
     *
     * @return JokeShare
     */
    public function setJoke(\AppBundle\Entity\Joke $joke = null)
    {
        $this->joke = $joke;

        return $this;
    }

    /**
     * Get joke
     *
     * @return \AppBundle\Entity\Joke
     */
    public function getJoke()
    {
        return $this->joke;
    }
}
