<?php

namespace App\Repositories\Criteria;

use App\Contracts\CriteriaInterface;
use App\Contracts\RepositoryInterface;

class AdminUserResourceCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        return $model;
    }
}