<?php

namespace App\Repositories;

interface GithubRepoRepositoryInterface
{
    public function all($perPage = 15);

    public function allSortedByPopularity($order = 'desc', $perPage = 15);

    public function allSortedByActivity($order = 'desc', $perPage = 15);
}
