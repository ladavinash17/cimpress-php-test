<?php

namespace Cimpress\RepoBundle\Controller;

use Cimpress\RepoBundle\Model\Repo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    private $repo;
    private $fullSpec;
    private $currentPage;

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
            'currentPage' => $this->currentPage,
        ]);
    }

    public function indexDataAction(Request $request) {

        $this->setSearchSpec($request);

        $data = $this->repo->getRepositories($this->fullSpec);

        return $data;
    }

    public function setSearchSpec(Request $request) {
        $requestData = $request->query->all();

        $this->fullSpec = [];
        $this->currentPage = 1;
        if(isset($requestData['language']) && !empty($requestData['language'])) {
            $this->fullSpec['searchSpec']['language'] = $requestData['language'];
        }
        if(isset($requestData['page']) && !empty($requestData['page'])) {
            $this->fullSpec['pageSpec']['currentPage'] = $requestData['page'];
            $this->currentPage = $requestData['page'];
        }
    }
}
