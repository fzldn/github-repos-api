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
     * @SWG\Get(
     *  path="/php",
     *  tags={"Github Repo"},
     *  @SWG\Parameter(ref="#/parameters/page_in_query"),
     *  @SWG\Parameter(ref="#/parameters/per_page_in_query"),
     *  @SWG\Response(response=200, description="Success"),
     * )
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
     * @SWG\Get(
     *  path="/popularity/php",
     *  tags={"Github Repo"},
     *  @SWG\Parameter(ref="#/parameters/page_in_query"),
     *  @SWG\Parameter(ref="#/parameters/per_page_in_query"),
     *  @SWG\Parameter(ref="#/parameters/order_in_query"),
     *  @SWG\Response(response=200, description="Success"),
     * )
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
     * @SWG\Get(
     *  path="/activity/php",
     *  tags={"Github Repo"},
     *  @SWG\Parameter(ref="#/parameters/page_in_query"),
     *  @SWG\Parameter(ref="#/parameters/per_page_in_query"),
     *  @SWG\Parameter(ref="#/parameters/order_in_query"),
     *  @SWG\Response(response=200, description="Success"),
     * )
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
