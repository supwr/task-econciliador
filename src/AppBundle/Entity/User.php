<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="text", nullable=true)
     */
    public $login;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar_url", type="text", nullable=true)
     */
    public $avatarUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="html_url", type="text", nullable=true)
     */
    public $htmlUrl;

    /**
     * @ORM\OneToMany(targetEntity="Repository", mappedBy="author")
     */
    private $repositories;

    /**
     * @return mixed
     */
    public function getRepositories()
    {
        return $this->repositories;
    }

    /**
     * @param mixed $repositories
     * @return User
     */
    public function setRepositories($repositories)
    {
        $this->repositories = $repositories;
        return $this;
    }


    /**
     * Set id
     *
     * @param integer $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set avatarUrl
     *
     * @param string $avatarUrl
     * @return User
     */
    public function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    /**
     * Get avatarUrl
     *
     * @return string 
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * Set htmlUrl
     *
     * @param string $htmlUrl
     * @return User
     */
    public function setHtmlUrl($htmlUrl)
    {
        $this->htmlUrl = $htmlUrl;

        return $this;
    }

    /**
     * Get htmlUrl
     *
     * @return string 
     */
    public function getHtmlUrl()
    {
        return $this->htmlUrl;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

}
