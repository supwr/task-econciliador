<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use GitHubClient\GitHubUser;
use GitHubClient\GitHubRepository;
use GuzzleHttp\Client;

class DefaultController extends Controller
{
    /**
     * @Route("/users/{u}", name="users")
     * @Method("GET")
     */
    public function getUsers(Request $request, $u = null)
    {

        $user = array();

        if(!is_null($u)) {
            $em = $this->getDoctrine()->getEntityManager()->createQueryBuilder();

            $user = $em->select('u')
                ->from('AppBundle:User','u')
                ->where('u.login = :u')
                ->setParameter('u', $u)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            if(count($user) == 0) {

                $request = new GitHubUser($this->container->get('doctrine')->getEntityManager(), $u);

                $user = $request->request();
            }

        }

        return new JsonResponse(array("user" => $user), 200);
    }

    /**
     * @Route("/repos/{u}", name="repos")
     * @Method("GET")
     */
    public function getRepos(Request $request, $u = null)
    {
        $user = array();

        if(!is_null($u)) {
            $em = $this->getDoctrine()->getEntityManager()->createQueryBuilder();

            $repos = $em->select('r', 'u')
                ->from('AppBundle:Repository','r')
                ->leftJoin('r.author', 'u')
                ->where('u.login = :u')
                ->setParameter('u', $u)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            if(count($repos) == 0) {

                $request = new GitHubRepository($this->container->get('doctrine')->getEntityManager(),$u);

                $repos = $request->request();
            }

        }

        return new JsonResponse(array("repos" => $repos), 200);
    }

    /**
     * @Route("/commits", name="commits")
     * @Method("GET")
     */
    public function getCommits(Request $request)
    {
        //https://api.github.com/repos/supwr/angular-facepoop/commits
        $commits = array();

        return new JsonResponse(array("commits" => $commits), 200);
    }

}
