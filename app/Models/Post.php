<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Post extends Model {
    use HasFactory;
    use SoftDeletes;

    /**
     * Let Laravel know that this field should be treated as a date field
     *
     * @var string[]
     */
    protected $dates = [ 'published_at' ];

    /**
     * Enable us to use the attributes when creating a post
     *
     * @var string[]
     */
    protected $fillable = [ 'title', 'description', 'content', 'image', 'published_at', 'category_id', 'tags', 'user_id' ];

    /**
     * Delete the image associated with the post
     */
    public function deleteImage() {
        Storage::delete( $this->image );
    }

    /**
     * The post model belongs to the category model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo( Category::class );
    }

    /**
     * A post can belong to a tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags() {
        return $this->belongsToMany( Tag::class );
    }

    /**
     * A post belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo( User::class );
    }

    /**
     * Check if a post has a certain tag
     *
     * @param int $tagId
     *
     * @return bool
     */
    public function hasTag( $tagId ) {
        return in_array( $tagId, $this->tags->pluck( 'id' )->toArray(), true );
    }

    /**
     * Return only the posts that are published
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopePublished( $query ) {
        return $query->where( 'published_at', '<=', now() );
    }

    /**
     * Search posts based on the query search
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeSearched( $query ) {
        $search = request()->query( 'search' );

        if ( ! $search ) {
            return $query->published();
        }

        return $query->published()->where( 'title', 'LIKE', "%{$search}%" );
    }
}
