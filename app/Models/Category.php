<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    use HasFactory;

    /**
     * Enable us to use the attributes when creating a category
     *
     * @var string[]
     */
    protected $fillable = [ 'name' ];

    /**
     * A category has many posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts() {
        return $this->hasMany( Post::class );
    }
}
