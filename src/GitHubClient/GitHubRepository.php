<?php

namespace GitHubClient;

use GuzzleHttp\Client;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Doctrine\ORM\EntityManager;

class GitHubRepository implements GitHubClientInterface
{
    private $client;
    private $login;
    private $eventDispatcher;
    private $em;
    const URL = 'https://api.github.com/users/#user#/repos';

    public function __construct(EntityManager$em, $login)
    {
        $this->em = $em;
        $this->client = new Client();
        $this->login = $login;
        $this->eventDispatcher = new EventDispatcher();
    }

    public function request()
    {
        $request = $this->client->request('GET', str_replace('#user#', $this->login, self::URL));
        $response = \json_decode($request->getBody(), true);

        $repos = array();

        if(count($response) > 0 && !array_key_exists('message',$response)) {

            foreach($response as $r){

                array_push($repos, array(
                        "id" => $r["id"],
                        "owner" => $r["owner"]["id"],
                        "name" => $r["name"],
                        "html_url" => $r["html_url"],
                        "description" => $r["description"],
                        "stargazers_count" => $r["stargazers_count"],
                        "created_at" => new \DateTime(date("Y-m-d H:i:s",strtotime($r["created_at"])))
                    )
                );
            }

            $eventRepo = new GitHubRepositoryEvent(
                $this->em,
                $repos
            );


            $this->eventDispatcher->addListener('new_repo', function (GitHubRepositoryEvent $eventRepo) {
                $eventRepo->addRepository();
            });

            $this->eventDispatcher->dispatch('new_repo', $eventRepo);

        }

        return $repos;
    }



}