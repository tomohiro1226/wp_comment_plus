<?php
/**
 * The Wp_CommentPlus Link Template Functions.
 *
 * Wp_Commentの拡張機能を提供します。
 *
 * @package Wp_CommentsPlus
 * @since 0.0.1
 * @author Tomohiro
 * @copyright 2020-2020
 */

/**
 * コメントをゴミ箱へ移動させるリンクの取得
 *
 * ※ エスケープして使ってください
 *
 * @since 0.0.1
 *
 * @param int|WP_Comment $comment_id Optional. Comment ID or WP_Comment object.
 * @return string|void The trash comment link URL for the given comment id.
 */
function get_trash_comment_link($comment_id = 0)
{
    $comment = get_comment($comment_id);

    // インターロック
    if (!$comment) {
        return;
    }

    if (!$comment->user_id == get_current_user_id()) {
        return;
    }

    // リンクの作成
    $query_arg = array(
        'do' => 'delete',
        'id' => $comment->comment_ID
    );
    $location = add_query_arg($query_arg, get_the_permalink());

    /**
     * Filters the comment trash link.
     *
     * @since 0.0.1
     *
     * @param string $location The trash link.
     */
    return apply_filters('get_wp_comments_plus_trash_comment_link', $location);
}

/**
 * コメントをゴミ箱へ移動させるリンクの表示(フォマット付き)
 *
 * @since 0.0.1
 *
 * @param string $text   Optional. Anchor text. If null, default is 'コメントの削除'. Default null.
 * @param string $before Optional. Display before trash link. Default empty.
 * @param string $after  Optional. Display after trash link. Default empty.
 */
function trash_comment_link($text = null, $before = '', $after = '')
{
    $comment = get_comment();

    // インターロック
    if (!$comment) {
        return;
    }
    
    if (!$comment->user_id == get_current_user_id()) {
        return;
    }

    // リンクの作成
    if (null === $text) {
        $text = 'コメントの削除';
    }

    $link = '<a class="comment-trash-link" href="' . esc_url(get_trash_comment_link($comment)) . '">' . $text . '</a>';

    /**
     * Filters the comment trash link anchor tag.
     *
     * @since 0.0.1
     *
     * @param string $link       Anchor tag for the trash link.
     * @param int    $comment_id Comment ID.
     * @param string $text       Anchor text.
     */
    echo $before . apply_filters('get_wp_comments_plus_trash_comment_link', $link, $comment->comment_ID, $text) . $after;
}
