<?php
/**
 * Wp_CommentsPlus Admin Functions.
 *
 * Wp_CommentsPlusを管理画面で設定出来るようにします。
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

/**
 * 管理画面からWp_CommentsPlusの設定を行う(initialize)
 *
 * @since 0.0.1
 *
 * @global object $wp_comment_plus The Wp_CommentsPlus object.
 */
function wp_comments_plus_admin()
{
    global $wp_comments_plus;

    echo 'This is the page content';

    return;
}

// End of File.
