<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportedJoke
 *
 * @ORM\Table(name="reported_joke")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReportedJokeRepository")
 */
class ReportedJoke
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
     * Many Reports have one author.
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * One report of abuse has one joke.
     * @ORM\OneToOne(targetEntity="Joke")
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
     * @return ReportedJoke
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
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     *
     * @return ReportedJoke
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
     * @return ReportedJoke
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
