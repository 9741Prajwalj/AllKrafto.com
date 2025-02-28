<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FlashDealProductsResource;
class FlashDealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       
        return [
            "id" => $this->id,
            "title" => $this->title,
            "background_color" => $this->background_color,
            "text_color" => $this->text_color,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "slug" => $this->slug,
            "banner_image" => $this->banner_image,
            "is_featured" => $this->is_featured,
            "AllProducts" => FlashDealProductsResource::collection($this->products??[]),
        ];
    }
}
