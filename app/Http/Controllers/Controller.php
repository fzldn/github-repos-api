<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @SWG\Swagger(
 *  basePath="/api",
 *  produces={"application/json"},
 *  consumes={"application/json"},
 * )
 *
 * @SWG\Info(
 *  title="Github Repo API",
 *  version="1.0.0"
 * )
 *
 * @SWG\Tag(
 *  name="Github Repo",
 *  description="Github Repositories with topic:php"
 * )
 *
 * @SWG\Parameter(
 *  parameter="page_in_query",
 *  in="query",
 *  name="page",
 *  description="Page number of the results to fetch.",
 *  type="integer",
 *  default=1
 * )
 *
 * @SWG\Parameter(
 *  parameter="per_page_in_query",
 *  in="query",
 *  name="per_page",
 *  description="Results per page.",
 *  type="integer",
 *  default=15
 * )
 *
 * @SWG\Parameter(
 *  parameter="order_in_query",
 *  in="query",
 *  name="order",
 *  description="Determines whether the first search result returned is the highest number of matches (desc) or lowest number of matches (asc).",
 *  type="string",
 *  enum={"asc","desc"},
 *  default="desc"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
