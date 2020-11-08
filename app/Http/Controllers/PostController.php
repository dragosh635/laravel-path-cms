<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller {

    /**
     * PostController constructor.
     *
     * Add middleware for create and store actions
     */
    public function __construct() {
        $this->middleware( 'verifiedCategoriesCount' )->only( [ 'create', 'store' ] );
    }

    /**
     * Lists all posts page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        return view( 'posts.index' )->with( 'posts', Post::all() );
    }

    /**
     * Create post page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create() {
        return view( 'posts.create' )->with( 'categories', Category::all() )->with( 'tags', Tag::all() );
    }

    /**
     * Save post action
     *
     * @param CreatePostRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store( CreatePostRequest $request ) {

        // upload the image
        $image = $request->image->store( 'posts' );

        //create the post
        $post = Post::create( [
            'title'        => $request->title,
            'description'  => $request->description,
            'content'      => $request->content,
            'image'        => $image,
            'published_at' => $request->published_at,
            'category_id'  => $request->category_id,
            'user_id'      => auth()->user()->id,
        ] );

        //connect the post with the specified tags
        if ( $request->tags ) {
            $post->tags()->attach( $request->tags );
        }

        session()->flash( 'success', 'Post Created successfully' );

        return redirect( route( 'posts.index' ) );
    }

    /**
     * Edit post page
     *
     * @param Post $post
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit( Post $post ) {
        return view( 'posts.create' )->with( 'post', $post )->with( 'categories', Category::all() )->with( 'tags', Tag::all() );
    }

    /**
     * Update post action
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update( UpdatePostRequest $request, Post $post ) {

        $data = $request->only( [ 'title', 'description', 'published_at', 'content', 'category_id' ] );

        //check if new image - upload it - delete old one
        if ( $request->hasFile( 'image' ) ) {
            $image = $request->image->store( 'posts' );

            $post->deleteImage();

            $data['image'] = $image;
        }

        if ( $request->tags ) {
            $post->tags()->sync( $request->tags );
        }

        $post->update( $data );

        session()->flash( 'success', 'Post Updated successfully' );

        return redirect( route( 'posts.index' ) );
    }

    /**
     * Delete post
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy( $id ) {

        $post = Post::withTrashed()->where( 'id', $id )->firstOrFail();

        if ( $post->trashed() ) {
            $post->deleteImage();
            $post->forceDelete();
        } else {
            $post->delete();
        }

        session()->flash( 'success', 'Post delete successfully' );

        return redirect( route( 'posts.index' ) );
    }

    /**
     * Show all the trashed posts
     */
    public function trashed() {
        return view( 'posts.index' )->withPosts( Post::onlyTrashed()->get() );
    }

    /**
     * Restore a previously trashed post
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore( $id ) {

        $post = Post::withTrashed()->where( 'id', $id )->firstOrFail();

        $post->restore();

        session()->flash( 'success', 'Post restored successfully' );

        return redirect()->back();
    }
}
