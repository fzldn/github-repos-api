<?php

namespace App\Repositories;

use App\Helpers\CollectionHelper;
use Github\ResultPager;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class GithubRepoRepository implements GithubRepoRepositoryInterface
{
    private $cacheTtl = 30 * 60; // 30 minutes

    private function searchRepositories()
    {
        return Cache::remember(__CLASS__ . '/' . __FUNCTION__, $this->cacheTtl, function () {
            $searchApi = GitHub::search();
            $paginator = new ResultPager(GitHub::connection(), 100);

            $params = ['topic:php', null, null];
            $response = $paginator->fetch($searchApi, 'repositories', $params);
            $repos = collect($response['items']);

            while ($repos->count() < 500) {
                $response = $paginator->fetchNext();
                $repos = $repos->merge($response['items']);
            }

            return $repos;
        });
    }

    private function sortByActivity($item)
    {
        return Carbon::parse($item['updated_at'])->timestamp;
    }

    public function all($perPage = 15)
    {
        $repos = $this->searchRepositories();

        return CollectionHelper::paginate($repos, $perPage);
    }

    public function allSortedByPopularity($order = 'desc', $perPage = 15)
    {
        if ($order === 'desc') {
            $repos = $this->searchRepositories()->sortByDesc('stargazers_count');
        } else {
            $repos = $this->searchRepositories()->sortBy('stargazers_count');
        }

        return CollectionHelper::paginate($repos, $perPage);
    }

    public function allSortedByActivity($order = 'desc', $perPage = 15)
    {
        if ($order === 'desc') {
            $repos = $this->searchRepositories()->sortByDesc(function ($repo) {
                return $this->sortByActivity($repo);
            });
        } else {
            $repos = $this->searchRepositories()->sortBy(function ($repo) {
                return $this->sortByActivity($repo);
            });
        }

        return CollectionHelper::paginate($repos, $perPage);
    }
}
