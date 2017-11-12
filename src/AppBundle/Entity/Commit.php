<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commit
 *
 * @ORM\Table(name="commit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommitRepository")
 */
class Commit
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
     * @var string
     *
     * @ORM\Column(name="sha", type="text")
     */
    private $sha;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="commiter_id", referencedColumnName="id")
     */
    private $commiter;

    /**
     * @ORM\ManyToOne(targetEntity="Repository")
     * @ORM\JoinColumn(name="repository_id", referencedColumnName="id")
     */
    private $repository;

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
     * Set sha
     *
     * @param string $sha
     * @return Commit
     */
    public function setSha($sha)
    {
        $this->sha = $sha;

        return $this;
    }

    /**
     * Get sha
     *
     * @return string 
     */
    public function getSha()
    {
        return $this->sha;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Commit
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Commit
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
     * @return mixed
     */
    public function getCommiter()
    {
        return $this->commiter;
    }

    /**
     * @param mixed $commiter
     * @return Commit
     */
    public function setCommiter($commiter)
    {
        $this->commiter = $commiter;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param mixed $repository
     * @return Commit
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
        return $this;
    }

}
