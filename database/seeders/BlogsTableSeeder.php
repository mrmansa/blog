<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;

class BlogsTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();

        Blog::create([
            'user_id' => $user->id,
            'title' => 'Welcome to the blog',
            'content' => 'This is a sample published blog. Replace with real content.',
            'image' => null,
            'status' => 'published'
        ]);
    }
}
