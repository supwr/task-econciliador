<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/users", name="users")
     *@Method("GET")
     */
    public function getUsers(Request $request)
    {
        $user = array();

        return new JsonResponse(array("user" => $user), 200);
    }

    /**
     * @Route("/repos", name="repos")
     *@Method("GET")
     */
    public function getRepos(Request $request)
    {
        $repos = array();

        return new JsonResponse(array("repos" => $repos), 200);
    }

    /**
     * @Route("/commits", name="commits")
     *@Method("GET")
     */
    public function getCommits(Request $request)
    {
        $commits = array();

        return new JsonResponse(array("commits" => $commits), 200);
    }

}
