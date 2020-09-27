<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://onlinewebtutorhub.blogspot.com/
 * @since      1.0.0
 *
 * @package    Books_Management_Tool
 * @subpackage Books_Management_Tool/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Books_Management_Tool
 * @subpackage Books_Management_Tool/public
 * @author     Online Web Tutor <onlinewebtutorhub@gmail.com>
 */
class Books_Management_Tool_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Books_Management_Tool_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Books_Management_Tool_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/books-management-tool-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Books_Management_Tool_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Books_Management_Tool_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/books-management-tool-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script($this->plugin_name, "smc_book",array(
			"name" => "Smart Coder",
			"author" => "Raihan Islam",
			"ajaxurl" => admin_url("admin-ajax.php")
		));

	}

	public function our_own_custom_page_template(){

		global $post;

		if($post->post_name == "book_tool"){

			$page_template = BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH."public/partials/book-tool-layout.php";
		}

		return $page_template;
	}

	public function load_book_tool_content(){

		ob_start();

		include_once BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH.'public/partials/tmpl-book-tool-content.php';

		$template = ob_get_contents();

		ob_end_clean();

		echo $template;
	}

	public function handle_ajax_request_public(){

		$param = isset($_REQUEST['param']) ? $_REQUEST['param'] : "";

		if(!empty($param)){

			if($param == "first_ajax_request"){

				echo json_encode(array(
					"status" => 1,
					"message" => "Successfully completed first ajax from frontend"
				));
			}
		}

		wp_die();
	}

}
