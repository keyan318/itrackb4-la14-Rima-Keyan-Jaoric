<?php

namespace App\Models;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
   protected $fillable=['title', 'genre_id', 
   'year', 'director', 'rating', 'duration', 'is_featured'];

   protected function casts():array{
    return[
        'is_featured'=>'boolean',
        'year'=>'integer',
        'rating'=>'float'
    ];
   }

   public function genre(): BelongsTo
   {
    return $this->belongsTo(Genre::class);
   }
}
