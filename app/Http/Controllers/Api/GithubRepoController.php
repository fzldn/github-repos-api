<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GithubRepo\IndexActivityRequest;
use App\Http\Requests\Api\GithubRepo\IndexPhpRequest;
use App\Http\Requests\Api\GithubRepo\IndexPopularityRequest;
use App\Http\Resources\Api\GithubRepoResource;
use App\Repositories\GithubRepoRepositoryInterface;

class GithubRepoController extends Controller
{
    /**
     * @var \App\Repositories\GithubRepoRepository
     */
    private $githubRepoRepository;

    public function __construct(GithubRepoRepositoryInterface $githubRepoRepository)
    {
        $this->githubRepoRepository = $githubRepoRepository;
    }

    /**
     * List all github repositories with the topic "php"
     *
     * @param \App\Http\Requests\Api\GithubRepo\IndexPhpRequest $request
     * @return \Illuminate\Http\Response
     */
    public function php(IndexPhpRequest $request)
    {
        $perPage = $request->input('per_page', 15);

        $repos = $this->githubRepoRepository->all($perPage);
        $repos->appends($request->all());

        return GithubRepoResource::collection($repos);
    }

    /**
     * List all github repositories with the topic "php" sorted by popularity (stargazers_count)
     *
     * @param \App\Http\Requests\Api\GithubRepo\IndexPopularityRequest $request
     * @return \Illuminate\Http\Response
     */
    public function popularity(IndexPopularityRequest $request)
    {
        $perPage = $request->input('per_page', 15);
        $order = $request->input('order', 'desc');

        $repos = $this->githubRepoRepository->allSortedByPopularity($order, $perPage);
        $repos->appends($request->all());

        return GithubRepoResource::collection($repos);
    }

    /**
     * List all github repositories with the topic "php" sorted by activity (updated_at)
     *
     * @param \App\Http\Requests\Api\GithubRepo\IndexActivityRequest $request
     * @return \Illuminate\Http\Response
     */
    public function activity(IndexActivityRequest $request)
    {
        $perPage = $request->input('per_page', 15);
        $order = $request->input('order', 'desc');

        $repos = $this->githubRepoRepository->allSortedByActivity($order, $perPage);
        $repos->appends($request->all());

        return GithubRepoResource::collection($repos);
    }
}
