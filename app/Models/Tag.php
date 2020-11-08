<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    use HasFactory;

    /**
     * Enable us to use the attributes when creating a post
     *
     * @var string[]
     */
    protected $fillable = [ 'name' ];

    /**
     * A tag can contain more posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts() {
        return $this->belongsToMany( Post::class );
    }
}
