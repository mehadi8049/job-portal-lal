<?php

namespace Modules\Blogs\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'slug'           => $this->slug,
            'category_id'    => $this->category_id,
            'content_short'  => $this->content_short,
            'content'        => $this->content,
            'thumb'          => $this->getThumbLink(),
            'time_read'      => $this->time_read,
            'is_featured'    => (bool) $this->is_featured,
            'is_active'      => (bool) $this->is_active,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
            'category'       => $this->whenLoaded('category', function () {
                return ['id' => $this->category->id, 'name' => $this->category->name];
            }),
        ];
    }
}
