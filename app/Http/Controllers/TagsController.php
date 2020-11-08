<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;

class TagsController extends Controller {

    /**
     * Show all the tags
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        return view( 'tags.index' )->with( 'tags', Tag::all() );
    }

    /**
     * Show the form for creating a new tag.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create() {
        return view( 'tags.create' );
    }

    /**
     * Save a tag in the databse
     *
     * @param CreateTagRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store( CreateTagRequest $request ) {

        Tag::create( [
            'name' => $request->name,
        ] );

        session()->flash( 'success', 'Tag created successfully' );

        return redirect( route( 'tags.index' ) );
    }

    /**
     * Edit tag page
     *
     * @param Tag $tag
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit( Tag $tag ) {
        return view( 'tags.create' )->with( 'tag', $tag );
    }

    /**
     * Update tag action
     *
     * @param UpdateTagRequest $request
     * @param Tag $tag
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update( UpdateTagRequest $request, Tag $tag ) {

        $tag->update( [
            'name' => $request->name,
        ] );

        $tag->save();

        session()->flash( 'success', 'Tag update successfully' );

        return redirect( route( 'tags.index' ) );
    }

    /**
     * Delete tag action
     *
     * @param Tag $tag
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy( Tag $tag ) {

        if ( $tag->posts->count() > 0 ) {
            session()->flash( 'error', 'Tag cannot be deleted because it is associated to some posts' );

            return redirect()->back();
        }

        $tag->delete();

        session()->flash('success','Tag deleted successfully');

        return redirect( route('tags.index') );
    }
}
