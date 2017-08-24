<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 24/8/17
 * Time: 12:14 PM
 */

namespace Cimpress\RepoBundle\Model;

class Repo
{

    private $client;
    private $repositories;

    public function __construct()
    {
        $this->client = new \Github\Client();
        $this->paginator  = new \Github\ResultPager($this->client);
        $this->repositories = [];
    }

    public function getRepositories($fullSpec)
    {

        // Fetching Repositories Using paginator->fetchAll() method
//        $organizationApi = $this->client->api('organization');
//
//        $parameters = array('symfony');
//
//        $searchSpec = (isset($fullSpec['searchSpec']) && !empty($fullSpec['searchSpec']))? $fullSpec['searchSpec'] : [] ;
//
//        if (isset($searchSpec['language']) && !empty($searchSpec['language'])){
//            $parameters['language'] = $searchSpec['language'];
//        }
//
//        $result = $this->paginator->fetchAll($organizationApi, 'repositories', $parameters);
//        $pagination = $this->paginator->getPagination();
//
//        return [
//            'repositories' => $result,
//            'pagination' => $pagination,
//        ];


        // Fetching Repositories Using api('repo') method
        $searchSpec = (isset($fullSpec['searchSpec']) && !empty($fullSpec['searchSpec']))? $fullSpec['searchSpec'] : [] ;
        $pageSpec = (isset($fullSpec['pageSpec']) && !empty($fullSpec['pageSpec']))? $fullSpec['pageSpec'] : [] ;

        $pageNo = (isset($pageSpec['currentPage']) && !empty($pageSpec['currentPage'])) ? $pageSpec['currentPage'] : 1;

        if (isset($searchSpec['language']) && !empty($searchSpec['language'])){
            $parameters['language'] = $searchSpec['language'];
        }
        $parameters['start_page'] = $pageNo;

        $repos = $this->client->api('repo')->find('symfony', $parameters);

        return $repos;
    }
}