<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller {

    /**
     * Show the blog post page
     *
     * @param Post $post
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show( Post $post ) {
        return view( 'blog.show' )->with( 'post', $post );
    }

    /**
     * Show the category page
     *
     * @param Category $category
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category( Category $category )
    {

        return view('blog.category')
            ->with( 'category', $category )
            ->with('posts', $category->posts()->searched()->simplePaginate(1) )
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    /**
     * Show the tag page
     *
     * @param Tag $tag
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function tag( Tag $tag )
    {
        return view('blog.tag')
            ->with( 'tag', $tag )
            ->with('posts', $tag->posts()->searched()->simplePaginate(1) )
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }
}
