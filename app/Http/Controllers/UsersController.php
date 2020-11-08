<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateProfileRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller {
    /**
     * Show all the users
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        return view( 'users.index' )->with( 'users', User::all() );
    }

    /**
     * Transform an user into an administrator
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function makeAdmin( User $user ) {
        $user->role = 'admin';
        $user->save();

        session()->flash( 'success', 'Users successfully made admin' );

        return redirect( route( 'users.index' ) );
    }

    /**
     * Show users edit page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit() {
        return view( 'users.edit' )->with( 'user', auth()->user() );
    }

    /**
     * Update user profile
     *
     * @param UpdateProfileRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( UpdateProfileRequest $request ) {
        $user = auth()->user();

        $user->update( [
            'name'  => $request->name,
            'about' => $request->about,
        ] );

        session()->flash( 'success', 'Users updated successfully' );

        return redirect()->back();
    }
}
