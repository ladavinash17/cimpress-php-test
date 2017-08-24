<?php

namespace Cimpress\RepoBundle\Controller;

use Cimpress\RepoBundle\Model\Repo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    private $repo;

    public function __construct()
    {
        $this->repo = new Repo();
    }

    /**
     * @Route(path="/", name="home_render")
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request)
    {
        $data = $this->indexDataAction($request);
        return $this->render('RepoBundle:Default:index.html.twig', [
            'data' => $data,
        ]);
    }

    public function indexDataAction(Request $request) {

        $fullSpec = $this->setSearchSpec($request);

        $data['repositories'] = $this->repo->getRepositories($fullSpec);

        return $data;
    }

    public function setSearchSpec(Request $request) {
        $requestData = $request->getContent();

        $fullSpec = [];
        if(isset($requestData['language']) && !empty($requestData['language'])) {
            $fullSpec['searchSpec']['language'] = $requestData['language'];
        }
        if(isset($requestData['page']) && !empty($requestData['page'])) {
            $fullSpec['pageSpec']['currentPage'] = $requestData['page'];
        }

        return $fullSpec;
    }
}
