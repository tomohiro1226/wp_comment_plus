<?php
/*
  Plugin Name: Wp_CommentPlus
  Plugin URI:
  Description: Wordpressのコメント機能の拡張である
  Version: 0.0.1
  Author: Tomohiro
  Author URI: https://github.com/tomohiro1226/wp_comment_plus
  License: GPLv2
 */


// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit();
}

// Initialize constants.
define('WP_COMMENT_PLUS_VERSION', '0.0.0');
define('WP_COMMENT_PLUS_PATH', plugin_dir_path(__FILE__));

// Initialize the plugin.
add_action('init', 'wp_comment_plus_init', 10);

/**
 * 初期化 Wp_CommentPlus.
 *
 * @since 0.0.1
 *
 * @global object $wp_comments_plus Wp_CommentPlusのオブジェクト.
 */
function wp_comment_plus_init()
{

    // Set the object as global.
    global $wp_comments_plus;

    /**
     * Load the Wp_CommentsPlus class.
     */
    require_once('includes/class-wp-comments-plus.php');

    // Invoke the Wp_CommentsPlus class.
    $wp_comments_plus = new Wp_CommentsPlus();
}
