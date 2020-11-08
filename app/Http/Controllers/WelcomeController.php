<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller {

    /**
     * Handle data from the home page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {

        return view( 'welcome' )
            ->with( 'categories', Category::all() )
            ->with( 'tags', Tag::all() )
            ->with( 'posts', Post::searched()->simplePaginate(2) );
    }
}
