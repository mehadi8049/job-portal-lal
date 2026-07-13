<?php

namespace Modules\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageProficiencyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'language_name'  => $this->language_name,
            'reading_level'  => $this->reading_level,
            'writing_level'  => $this->writing_level,
            'speaking_level' => $this->speaking_level,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
        ];
    }
}
