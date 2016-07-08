<?php
namespace Larapress\Posts\Database\Seeds;

use Illuminate\Database\Seeder;
use Larapress\Posts\Database\Factories\PostFactory;

class PostsTableSeeder extends Seeder
{
    public function __construct(PostFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x < 4; $x++) {
            $category = $this->factory->category();

            $category->save();

            $this->addPosts();
        }
    }

    /**
     * @return \Larapress\Posts\Models\Post
     */
    private function addPosts()
    {
        for ($x = 0; $x < rand(1, 5); $x++) {
            $post = $this->factory->post();

            $post->save();

            $this->addComments($post);

            return $post;
        }
    }

    /**
     * @param $comment
     * @return int
     */
    private function addReplies($comment)
    {
        for ($x = 0; $x < rand(1, 3); $x++) {
            $reply = $this->factory->reply();

            $reply->comment_id = $comment->id;

            $reply->save();
        }
        return $x;
    }

    /**
     * @param $post
     */
    private function addComments($post)
    {
        for ($x = 0; $x < rand(1, 10); $x++) {
            $comment = $this->factory->comment();

            $comment->post_id = $post->id;

            $comment->save();

            $this->addReplies($comment);

        }
    }
}
