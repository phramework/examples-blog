<?php

namespace Phramework\Examples\Blog\Controllers;

use \Phramework\Phramework;
use \Phramework\Validate\Validate;
use \Phramework\Models\Request;
use \Phramework\Examples\Blog\Models\Post;

class PostController
{
    public static function GET($params, $method, $headers)
    {
        /*if (($id = Request::resourceId($params)) !== FALSE) {
            echo '<pre>';
            print_r([$params, $method, $headers]);
            echo '</pre>';
            throw new \Phramework\Exceptions\MissingParametersException\NotImplemented();
        }*/

        $posts = Post::getAll();

        Phramework::view([
            'posts' => $posts,
        ], 'blog', 'My blog'); //will load viewers/page/blog.php
    }

    public static function GETSingle($params, $method, $headers)
    {
        $id = Request::requireId($params);

        $posts = Post::getAll();

        array_unshift($posts, []);

        if ($id == 0 || $id > count($posts) - 1) {
            throw new \Phramework\Exceptions\NotFoundException('Post not found');
        }

        Phramework::view([
            'posts' => [$posts[$id]],
        ], 'blog', 'My blog #' . $id); //will load viewers/page/blog.php
    }
}
