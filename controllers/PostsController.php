<?php

namespace Phanbook\Controllers;

use Phanbook\Models\Posts;
use Phanbook\Models\PostsTags;
/**
 * Class UserController
 */
class PostsController extends ControllerBase
{


    /**
     * indexAction function.
     *
     * @access public
     * @return void
     */
    public function index()
    {
        d('store phanbook');
    }
    public function mysql()
    {
        //d('mysql');
        $this->db->begin();

        $tag = new PostsTags;
        $tag->postsId = 1;
        $tag->tagsId  = 2;
        if (!$tag->save()) {
            $this->db->rollback();
            return;
        }
        $post = new Posts();
        $post->title = 'Test';
        $post->usersId = 1;
        $post->type = 'blog';
        //$post->slug = 'abc';

        if ($post->save() == false) {
            d($post->getMessages());
            $this->db->rollback();
            return;
        }

        // Commit the transaction
        $this->db->commit();
    }

}
