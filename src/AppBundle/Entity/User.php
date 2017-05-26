<?php
/**
 * Created by PhpStorm.
 * User: tk
 * Date: 27/05/2017
 * Time: 1:19 AM
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints AS Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * A user's real first name.
     * @Assert\NotBlank(message="Please provide your first name.")
     * * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string",length=20)
     * @var string
     */
    protected $firstName;
    /**
     * A user's real other names.
     * @Assert\NotBlank(message="Please provide your other names.")
     * * * @Assert\Length(
     *      min = 2,
     *      max = 40,
     *      minMessage = "Your other names must be at least {{ limit }} characters long",
     *      maxMessage = "Your other names cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string",length=40)
     * @var string
     */
    protected $otherNames;
    /**
     * A user's comic name.
     * @Assert\NotBlank(message="Please provide a comic name.")
     * * * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "Your comic name must be at least {{ limit }} characters long",
     *      maxMessage = "Your comic name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string",length=20)
     * @var string
     */
    protected $comicName;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set otherNames
     *
     * @param string $otherNames
     *
     * @return User
     */
    public function setOtherNames($otherNames)
    {
        $this->otherNames = $otherNames;

        return $this;
    }

    /**
     * Get otherNames
     *
     * @return string
     */
    public function getOtherNames()
    {
        return $this->otherNames;
    }

    /**
     * Set comicName
     *
     * @param string $comicName
     *
     * @return User
     */
    public function setComicName($comicName)
    {
        $this->comicName = $comicName;

        return $this;
    }

    /**
     * Get comicName
     *
     * @return string
     */
    public function getComicName()
    {
        return $this->comicName;
    }
}
