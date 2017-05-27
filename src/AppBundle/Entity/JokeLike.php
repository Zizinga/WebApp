<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JokeLike
 *
 * @ORM\Table(name="joke_like")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JokeLikeRepository")
 */
class JokeLike
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
     * Many likes have one author.
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * Many likes belong to one joke.
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
     * @return JokeLike
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
     * @return JokeLike
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
     * @return JokeLike
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
