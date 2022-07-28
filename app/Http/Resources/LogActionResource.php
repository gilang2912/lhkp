<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogActionResource extends JsonResource
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
            'id' => $this->id,
            'subject' => $this->subject,
            'url' => $this->url,
            'method' => $this->method,
            'ip' => $this->ip,
            'user_agent' => $this->agent,
            'user_id' => $this->user_id,
            'log_time' => ($this->created_at)->format('d-m-Y H:i:s')
        ];
    }
}
