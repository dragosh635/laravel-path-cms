<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $author1 = User::create( [
            'name'     => 'Jon Doe',
            'email'    => 'jon@doe.com',
            'password' => Hash::make( 'dragos123' ),
        ] );

        $author2 = User::create( [
            'name'     => 'Jon1 Doe',
            'email'    => 'jon1@doe.com',
            'password' => Hash::make( 'dragos123' ),
        ] );

        $category1 = Category::create( [
            'name' => 'News',
        ] );

        $category2 = Category::create( [
            'name' => 'Marketing',
        ] );

        $category3 = Category::create( [
            'name' => 'Partnership',
        ] );

        $tag1 = Tag::create( [
            'name' => 'job',
        ] );

        $tag2 = Tag::create( [
            'name' => 'customers',
        ] );

        $tag3 = Tag::create( [
            'name' => 'record',
        ] );

        $post1 = Post::create( [
            'title'       => 'We relocated our office to a new designed garage',
            'description' => 'ontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum',
            'content'     => 'ontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum',
            'category_id' => $category1->id,
            'image'       => 'posts/1.jpg',
            'user_id'     => $author1->id,
        ] );

        $post1->tags()->attach( [ $tag1->id, $tag2->id ] );

        $post2 = $author2->posts()->create( [
            'title'       => 'Top 5 brilliant content marketing strategies',
            'description' => 'ontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum',
            'content'     => 'ontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum',
            'category_id' => $category2->id,
            'image'       => 'posts/2.jpg',
        ] );

        $post2->tags()->attach( [ $tag2->id, $tag3->id ] );

        $post3 = $author1->posts()->create( [
            'title'       => 'Best practices for minimalist design with example',
            'description' => 'ontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum',
            'content'     => 'ontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum',
            'category_id' => $category3->id,
            'image'       => 'posts/3.jpg',
        ] );

        $post3->tags()->attach( [ $tag1->id, $tag2->id ] );

        $post4 = $author2->posts()->create( [
            'title'       => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'ontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum',
            'content'     => 'ontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum',
            'category_id' => $category2->id,
            'image'       => 'posts/4.jpg',
        ] );
    }
}
