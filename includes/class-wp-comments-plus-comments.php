<?php
/**
 * The Wp_CommentPlus Comments Class.
 *
 * Wp_Commentの拡張機能を提供します。
 *
 * @package Wp_CommentsPlus
 * @since 0.0.1
 * @author Tomohiro
 * @copyright 2020-2020
 */

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit();
}

class Wp_CommentsPlus_Comments
{

    /**
     * construct.
     *
     * @since 0.0.1
     */
    public function __construct()
    {
    }

    /**
     * コメントをゴミ箱へ移動させる
     * ただし、「$comment_ID」で指定されたコメントが自分のコメントだった場合に限る
     *
     * @since 0.0.1
     *
     * @param int        $comment_ID The comment ID.
     */
    public function trash($comment_ID = 0)
    {
        if (is_user_logged_in() && !empty($comment_ID)) {
            $comment = get_comment($comment_ID);

            if (!$comment) {
                return;
            }
    
            if ($comment->user_id == get_current_user_id()) {
                wp_trash_comment($comment_ID);
            }
        }
    }

    /**
     * コメントをゴミ箱から取り出す
     * ただし、「$comment_ID」で指定されたコメントが自分のコメントだった場合に限る
     *
     * @since 0.0.1
     *
     * @param int        $comment_ID The comment ID.
     */
    public function untrash($comment_ID = 0)
    {
        if (is_user_logged_in() && !empty($comment_ID)) {
            $comment = get_comment($comment_ID);

            if (!$comment) {
                return;
            }
    
            if ($comment->user_id == get_current_user_id()) {
                wp_untrash_comment($comment_ID);
            }
        }
    }
}
