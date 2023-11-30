<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'genre' => $this->genre,
            'isbn' => $this->isbn,
            'image' => $this->image,
            'published' => $this->published,
            'publisher' => $this->publisher,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
        ];

        if ($request->routeIs('api.books.show')) {
            $data['desc'] = $this->desc;
        }

        return $data;
    }
}
