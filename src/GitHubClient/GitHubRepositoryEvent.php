<?php

namespace GitHubClient;

use AppBundle\Entity\Repository;
use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class GitHubRepositoryEvent extends Event
{
    private $repos;
    private $em;

    public function __construct(EntityManager $em, $repos)
    {
        $this->repos = $repos;
        $this->em = $em;
    }

    /**
     * @return mixed
     */
    public function getRepos()
    {
        return $this->repos;
    }

    /**
     * @param mixed $repos
     */
    public function setRepos($repos)
    {
        $this->repos = $repos;
    }

    /**
     * @return EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @param EntityManager $em
     */
    public function setEm($em)
    {
        $this->em = $em;
    }


    public function addRepository(){

        foreach($this->repos as $r){
            $repo = new Repository();
            $repo->setId($r["id"]);
            $repo->setName($r["name"]);
            $repo->setHtmlUrl($r["html_url"]);
            $repo->setAuthor($this->em->getRepository("AppBundle:User")->findOneBy(array("id" => $r["owner"])));
            $repo->setDescription($r["description"]);
            $repo->setStargazersCount($r["stargazers_count"]);
            $repo->setCreatedAt($r["created_at"]);

            $this->em->persist($repo);
        }

        $this->em->flush();
    }


}