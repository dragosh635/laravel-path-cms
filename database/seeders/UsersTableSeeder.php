<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $user = User::where( 'email', 'dragos.petcu@bitstone.eu' )->get()->first();

        if ( ! $user ) {
            User::create( [
                'name'     => 'Dragos',
                'email'    => 'dragos.petcu@bitstone.eu',
                'role'     => 'admin',
                'password' => Hash::make( 'dragos123' ),
            ] );
        }
    }
}
