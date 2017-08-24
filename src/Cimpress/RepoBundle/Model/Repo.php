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
        $this->repositories = [];
    }

    public function getRepositories($fullSpec)
    {
        $searchSpec = (isset($fullSpec['searchSpec']) && !empty($fullSpec['searchSpec']))? $fullSpec['searchSpec'] : [] ;
        $pageSpec = (isset($fullSpec['pageSpec']) && !empty($fullSpec['pageSpec']))? $fullSpec['pageSpec'] : [] ;

        $pageNo = (isset($pageSpec['currentPage']) && !empty($pageSpec['currentPage'])) ? $pageSpec['currentPage'] : 1;

        $criteria = $searchSpec;
        $criteria['start_page'] = $pageNo;

//        if (!empty($searchSpec)) {
//            foreach ($searchSpec as $key=> $value) {
//
//            }
//        }

        $repos = $this->client->api('repo')->find('symfony', $criteria);

        if(isset($repos['repositories']) && !empty($repos['repositories'])) {
            return $repos['repositories'];
        } else {
            return $repos;
        }
    }
}