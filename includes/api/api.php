<?php
/**
 * Wp_CommentsPlus API Functions
 *
 * @package Wp_CommentsPlus
 * @since 0.0.1
 * @author Tomohiro
 * @copyright 2020-2020
 *
 * Functions included:
 * - del_come_get
 */

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit();
}

/**
 * [Utility function] $_POST, $_GET, and $_REQUESTで取得したデータを検証する
 *
 * ※ 取得したデータを使う際は、サニタイズやエスケープを行ってください。
 *
 * @since 0.0.1
 *
 * @param  string $tag     The form field or query string.
 * @param  string $default The default value (optional).
 * @param  string $type    post|get|request (optional).
 * @return string
 */
function del_come_get($tag, $default = '', $type = 'post')
{
    switch ($type) {
        case 'get':
            return (isset($_GET[ $tag ])) ? $_GET[ $tag ] : $default;
            break;
        case 'request':
            return (isset($_REQUEST[ $tag ])) ? $_REQUEST[ $tag ] : $default;
            break;
        default: // case 'post':
            return (isset($_POST[ $tag ])) ? $_POST[ $tag ] : $default;
            break;
    }
}

// End of file.
