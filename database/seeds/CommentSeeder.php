<?php

use App\Comment;
use App\News;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::all()->each(function (News $news) {
            factory(Comment::class, rand(1, 3))->create([$news->getForeignKey() => $news->getKey()]);
        });
    }
}
