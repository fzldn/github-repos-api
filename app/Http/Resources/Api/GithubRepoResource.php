<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class GithubRepoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'full_name' => $this['full_name'],
            'html_url' => $this['html_url'],
            'language' => $this['language'],
            'updated_at' => $this['updated_at'],
            'pushed_at' => $this['pushed_at'],
            'stargazers_count' => $this['stargazers_count'],
        ];
    }
}
