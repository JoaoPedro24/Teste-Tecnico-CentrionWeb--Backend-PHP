<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
         return [
            'id'      => $this->id,
            'user_id' => $this->userId,
            'title'   => $this->title,
            'body'    => $this->body,
            'created_at' => Carbon::make($this->created_at)->format('Y-m-d h:i:s'),
            'updated_at' => Carbon::make($this->updated_at)->format('Y-m-d h:i:s'),
        ];
    }
}
