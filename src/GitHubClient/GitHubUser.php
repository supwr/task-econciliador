<?php

namespace GitHubClient;

use GuzzleHttp\Client;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcher;

class GitHubUser implements GitHubClientInterface
{
    private $client;
    private $login;
    private $em;
    private $eventDispatcher;
    const URL = 'https://api.github.com/search/users';

    public function __construct(EntityManager$em, $login)
    {
        $this->em = $em;
        $this->client = new Client();
        $this->login = $login;
        $this->eventDispatcher = new EventDispatcher();
    }

    public function request()
    {
        $request = $this->client->request('GET', self::URL."?q={$this->login}");
        $response = \json_decode($request->getBody(), true);

        $user = array();

        if(count($response) > 0 && $response["total_count"] > 0) {

            $user["id"] = $response["items"][0]["id"];
            $user["login"] = $response["items"][0]["login"];
            $user["avatar_url"] = $response["items"][0]["avatar_url"];
            $user["html_url"] = $response["items"][0]["html_url"];

            $eventUser = new GitHubUserEvent(
                $this->em,
                $user
            );

            $this->eventDispatcher->addListener('new_user', function (GitHubUserEvent $eventUser) {
                $eventUser->addUser();
            });

            $this->eventDispatcher->dispatch('new_user', $eventUser);

        }

        return $user;
    }



}