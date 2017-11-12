<?php

namespace GitHubClient;

use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class GitHubUserEvent extends Event
{
    private $id;
    private $login;
    private $avatar;
    private $htmlUrl;
    private $em;

    public function __construct(EntityManager $em, $user)
    {
        $this->id = $user["id"];
        $this->login = $user["login"];
        $this->avatar = $user["avatar_url"];
        $this->htmlUrl = $user["html_url"];
        $this->em = $em;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return GitHubUserEvent
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     * @return GitHubUserEvent
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     * @return GitHubUserEvent
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHtmlUrl()
    {
        return $this->htmlUrl;
    }

    /**
     * @param mixed $htmlUrl
     * @return GitHubUserEvent
     */
    public function setHtmlUrl($htmlUrl)
    {
        $this->htmlUrl = $htmlUrl;
        return $this;
    }

    public function addUser(){

        $user = new User();
        $user->setId($this->id);
        $user->setLogin($this->login);
        $user->setAvatarUrl($this->avatar);
        $user->setHtmlUrl($this->htmlUrl);

        $this->em->persist($user);
        $this->em->flush();
    }

}
