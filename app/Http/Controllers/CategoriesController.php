<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class CategoriesController extends Controller {

    /**
     * Show all the categories
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        return view( 'categories.index' )->with( 'categories', Category::all() );
    }

    /**
     * Create a category page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create() {
        return view( 'categories.create' );
    }

    /**
     * Save a new category to the database
     *
     * @param CreateCategoryRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store( CreateCategoryRequest $request ) {

        Category::create( [
            'name' => $request->name,
        ] );

        session()->flash( 'success', 'Category created successfully' );

        return redirect( route( 'categories.index' ) );
    }

    /**
     * Edit category page
     *
     * @param Category $category
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit( Category $category ) {
        return view( 'categories.create' )->with( 'category', $category );
    }

    /**
     * Update category
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update( UpdateCategoryRequest $request, Category $category ) {

        $category->update( [
            'name' => $request->name,
        ] );

        $category->save();

        session()->flash( 'success', 'Category update successfully' );

        return redirect( route( 'categories.index' ) );
    }

    /**
     * Delete category
     *
     * @param Category $category
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy( Category $category ) {

        /* If the category has some posts in it do not delete it */
        if ( $category->posts->count() > 0 ) {
            session()->flash( 'error', 'Category cannot be deleted because it has some posts' );

            return redirect()->back();
        }

        $category->delete();

        session()->flash( 'success', 'Category deleted successfully' );

        return redirect( route( 'categories.index' ) );
    }
}
