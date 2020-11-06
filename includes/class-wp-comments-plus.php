<?php
/**
 * The Wp_CommentsPlus Class.
 *
 * Wp_CommentsPlusのメインクラスです。
 * クラス生成時に以下の初期化を行います。
 * - shrtcodes
 * - hooks
 * - admin menu
 *
 * @package Wp_CommentsPlus
 * @since 0.0.1
 * @author Tomohiro
 * @copyright 2020-2020
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit();
}

class Wp_CommentsPlus
{

    /**
     * Plugin version.
     *
     * @since  0.0.1
     * @access public
     * @var    string
     */
    public $version = WP_COMMENT_PLUS_VERSION;
    
    /**
     * Plugin path.
     *
     * @since  0.0.1
     * @access public
     * @var    string
     */
    public $path;
    
    /**
     * Plugin __FILE__.
     *
     * @since  0.0.1
     * @access public
     * @var    string
     */
    public $name;
    
    /**
     * Plugin slug.
     *
     * @since  0.0.1
     * @access public
     * @var    string
     */
    public $slug;
    
    /**
     * construct.
     *
     * @since 0.0.1
     */
    public function __construct()
    {

        // Constants.
        $this->path = plugin_dir_path(__DIR__);
        $this->name = $this->path . 'wp-comments-plus';
        $this->slug = substr(basename($this->name), 0, -4);
        
        // Load dependent files.
        $this->load_dependencies();

        // Load actions and filters.
        $this->load_hooks();

        $this->comments = new Wp_CommentsPlus_Comments();
    }

    /**
     * Hookを作成する。
     *
     * @since 0.0.1
     */
    private function load_hooks()
    {
        // Add actions.
        add_action('admin_menu', array( $this, 'admin_options'));
        add_action('template_redirect', array( $this, 'get_action'));
        add_action('wp_enqueue_scripts', array( $this, 'load_external_dependencies'));
    }
    
    /**
     * 管理画面にWP_CommentsPlusの設定ページを配置する.
     *
     * @since 0.0.1
     */
    public function admin_options()
    {
        add_options_page(
            'WP_CommentsPlusの設定',  	   /* ページタイトル*/
            'WP_CommentsPlus',       	  /* メニュータイトル */
            'manage_options',             /* 権限 */
            'wp-comments-plus-option',    /* ページを開いたときのURL */
            'wp_comments_plus_admin'      /* メニューに紐づく画面を描画するcallback関数 */
        );
    }

    /**
     * リクエスト(GET,POST)のアクションを取得する
     *
     * @since 0.0.1
     *
     */
    public function get_action()
    {

        // Get the action being done.
        $this->action = sanitize_text_field(del_come_get('do', '', 'request'));

        // Get the regchk value.
        $this->regchk = $this->get_regchk($this->action);
    }

    /**
     * リクエスト(GET,POST)で指示されたアクションを行う
     *
     * @since 0.0.1
     *
     * @param  string $action The current action.
     * @return string         The regchk value.
     */
    public function get_regchk($action)
    {
        $regchk = '';
        $comment_ID = sanitize_text_field(del_come_get('id', '', 'request'));

        switch ($action) {

            case 'delete':
                $regchk = $this->comments->trash($comment_ID);
                break;

            case 'untrash':
                $regchk = $this->comments->untrash($comment_ID);
                break;

            default:
                break;
        }
        
        return $regchk;
    }

    /**
     * Load dependent files.
     *
     * @since 0.0.1
     */
    public function load_dependencies()
    {

        // Wp_CommentPlus classes
        require_once($this->path . 'includes/class-wp-comments-plus-comments.php');
        require_once($this->path . 'includes/link-template.php');

        // api
        require_once($this->path . 'includes/api/api.php');

        // admin
        require_once($this->path . 'includes/admin/admin.php');
    }

    /**s
     * Load dependent external files.
     *
     * @since 0.0.1
     */
    public function load_external_dependencies()
    {
        wp_enqueue_style('dashicons');

        wp_enqueue_script(
            'modal-window-bundle',
            wp_comments_plus_includes_path('views/dist/wp-comments-plus.js'),
            array(),
            '0.0.1',
            true
        );
    }
} // end of class
