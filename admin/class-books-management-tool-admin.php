<?php
 
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://smartcoder.blogspot.com/
 * @since      1.0.0
 *
 * @package    Books_Management_Tool
 * @subpackage Books_Management_Tool/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Books_Management_Tool
 * @subpackage Books_Management_Tool/admin
 * @author     Online Web Tutor <smartcoder@gmail.com>
 */
class Books_Management_Tool_Admin {

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

	private $table_activator;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		require_once BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH . 'includes/class-books-management-tool-activator.php';
	$activator = new Books_Management_Tool_Activator();
		$this->table_activator = $activator;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		$valid_pages = array("book-management-tool", "book-management-create-book", "book-management-list-book", "book-management-create-book-shelf", "book-management-list-book-shelf");

		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";

		if(in_array($page, $valid_pages)){

			// adding css files in valid pages
			wp_enqueue_style( "smc-bootstrap", BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/css/bootstrap.min.css', array(), $this->version, 'all' );

			wp_enqueue_style( "smc-datatable", BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/css/jquery.dataTables.min.css', array(), $this->version, 'all' );

			wp_enqueue_style( "smc-sweetalert", BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/css/sweetalert.css', array(), $this->version, 'all' );
		}

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/books-management-tool-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		$valid_pages = array("book-management-tool", "book-management-create-book", "book-management-list-book", "book-management-create-book-shelf", "book-management-list-book-shelf");

		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";

		if(in_array($page, $valid_pages)){

			wp_enqueue_script("jquery");

		wp_enqueue_script( "smc-bootstrap-js", BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( "smc-datatable-js", BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( "smc-validate-js", BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/js/jquery.validate.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( "smc-sweetalert-js", BOOKS_MANAGEMENT_TOOL_PLUGIN_URL . 'assets/js/sweetalert.min.js', array( 'jquery' ), $this->version, false );


		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/books-management-tool-admin.js', array( 'jquery' ), $this->version, false );

		wp_localize_script($this->plugin_name, "smc_book",array(
			"name" => "Smart Coder",
			"author" => "Raihan Islam",
			"ajaxurl" => admin_url("admin-ajax.php")
		));

		}
	}

	// create menu method
	public function book_management_menu(){

		add_menu_page("Advanced Plugin", "Advanced Plugin", "manage_options", "book-management-tool", array($this, "book_management_plugin"));

    // create plugin submenus
		add_submenu_page("book-management-tool","Dashboard", "Dashboard", "manage_options", "book-management-tool", array($this, "book_management_plugin"));

		add_submenu_page("book-management-tool","Create Book Shelf", "Create Book Shelf", "manage_options", "book-management-create-book-shelf", array($this, "book_management_create_book_shelf"));

		add_submenu_page("book-management-tool","List Book Shelf", "List Book Shelf", "manage_options", "book-management-list-book-shelf", array($this, "book_management_list_book_shelf"));

		add_submenu_page("book-management-tool","Create Book", "Create Book", "manage_options", "book-management-create-book", array($this, "book_management_create_book"));

		add_submenu_page("book-management-tool","List Book", "List Book", "manage_options", "book-management-list-book", array($this, "book_management_list_book"));
	}

	// menu callback function
	public function book_management_dashboard(){

		echo "<h3>Welcome to Plugin dashboard</h3>";
	}

	public function book_management_list_book_shelf(){

		global $wpdb;

		$book_shelf = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * FROM ".$this->table_activator->wp_smc_tbl_book_shelf(), ""
			)
		);

		//echo "<pre>";
		//print_r($book_shelf);

		ob_start(); // started buffer

		include_once(BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH."admin/partials/tmpl-list-book-shelf.php"); // included template file

		$template = ob_get_contents(); // reading content

		ob_end_clean(); // closing and cleaning buffer

		echo $template;
	}

	// create book shelf layout
	public function book_management_create_book_shelf(){

		ob_start(); // started buffer

		include_once(BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH."admin/partials/tmpl-create-book-shelf.php"); // included template file

		$template = ob_get_contents(); // reading content

		ob_end_clean(); // closing and cleaning buffer

		echo $template;
	}

	public function book_management_list_book(){

		global $wpdb;

		$books_data = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT book.*, book_shelf.shelf_name from ".$this->table_activator->wp_smc_tbl_books(). " as book LEFT JOIN ".$this->table_activator->wp_smc_tbl_book_shelf()." as book_shelf ON book.shelf_id = book_shelf.id ORDER BY id DESC", ""
			)
		);

		//echo "<pre>";

		//print_r($books_data);

		ob_start(); // started buffer

		include_once(BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH."admin/partials/tmpl-list-books.php"); // included template file

		$template = ob_get_contents(); // reading content

		ob_end_clean(); // closing and cleaning buffer

		echo $template;
	}

	public function book_management_create_book(){
		global $wpdb;

		$book_shelf = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT id,shelf_name FROM ".$this->table_activator->wp_smc_tbl_book_shelf(), ""
			)
		);

		ob_start(); // started buffer

		include_once(BOOKS_MANAGEMENT_TOOL_PLUGIN_PATH."admin/partials/tmpl-create-book.php"); // included template file

		$template = ob_get_contents(); // reading content

		ob_end_clean(); // closing and cleaning buffer

		echo $template;
	}

  public function book_management_plugin(){

		global $wpdb;

		$post_row = $wpdb->get_row(
			$wpdb->prepare("SELECT * from wp_posts WHERE ID = %d", 1)
		);

		echo "<pre>";

		print_r($post_row);

	}

	public function handle_ajax_requests_admin(){

		global $wpdb;

		// handles all ajax request of admin
		$param = isset($_REQUEST['param']) ? $_REQUEST['param'] : "";

		if(!empty($param)){

			if($param == "first_simple_ajax"){

				echo json_encode(array(
					"status" => 1,
					"message" => "First Ajax Request",
					"data" => array(
						"name" => "Online Web Tutor",
						"author" => "Sanjay Kumar"
					)
				));
			}elseif($param == "create_book_shelf"){

				// get all data from form
				$name = isset($_REQUEST['txt_name']) ? $_REQUEST['txt_name'] : "";
				$capacity = isset($_REQUEST['txt_capacity']) ? $_REQUEST['txt_capacity'] : "";
				$location = isset($_REQUEST['txt_location']) ? $_REQUEST['txt_location'] : "";
				$status = isset($_REQUEST['dd_status']) ? $_REQUEST['dd_status'] : "";

				$wpdb->insert($this->table_activator->wp_smc_tbl_book_shelf(), array(
					"shelf_name" => $name,
					"capacity" => $capacity,
					"shelf_location" => $location,
					"status" => $status
				));

				if($wpdb->insert_id > 0){

					echo json_encode(array(
						"status" => 1,
						"message" => "Book Shelf created successfully"
					));
				}else{

					echo json_encode(array(
						"status" => 0,
						"message" => "Failed to create book shelf"
					));
				}

			}elseif($param == "delete_book_shelf"){
				$shelf_id = isset($_REQUEST['shelf_id']) ? $_REQUEST['shelf_id'] : 0;

				if($shelf_id > 0){

					$wpdb->delete($this->table_activator->wp_smc_tbl_book_shelf(),array(
						"id" => $shelf_id
					));

					echo json_encode(array(
						"status" => 1,
						"message" => "Book Shelf Delete successfully"
					));

				}else {
					echo json_encode(array(
						"status" => 0,
						"message" => "Failed to Delete book shelf"
					));
				}

			}elseif($param == "create_book"){
				//print($_REQUEST);

				$shelf_id = isset($_REQUEST['dd_book_shelf']) ? intval($_REQUEST['dd_book_shelf']) : 0;

				$txt_name = isset($_REQUEST['txt_name']) ? $_REQUEST['txt_name'] : "";

				$book_cover_image = isset($_REQUEST['book_cover_image']) ? $_REQUEST['book_cover_image'] : "";

				$txt_email = isset($_REQUEST['txt_email']) ? $_REQUEST['txt_email'] : "";

				$txt_publication = isset($_REQUEST['txt_publication']) ? $_REQUEST['txt_publication'] : "";

				$text_description = isset($_REQUEST['text_description']) ? $_REQUEST['text_description'] : "";

				$txt_cost = isset($_REQUEST['txt_cost']) ? intval($_REQUEST['txt_cost']) : 0;

				$dd_status = isset($_REQUEST['dd_status']) ? intval($_REQUEST['dd_status']) : 0;

				$wpdb->insert($this->table_activator->wp_smc_tbl_books(), array(
					"name" =>  strtolower($txt_name),
					"amount" =>  $txt_cost,
					"description" => $text_description,
					"publication" => $txt_publication,
					"email" => $txt_email,
					"shelf_id" => $shelf_id,
					"book_image" => $book_cover_image,
					"status" => $dd_status
				));

				if($wpdb->insert_id > 0){

					echo json_encode(array(
						"status" => 1,
						"message" => "Book created successfully"
					));
				}else{
				    echo json_encode(array(
						"status" => 0,
						"message" => "Failed to create book"
					));	
				}

			}
		}

		wp_die();

	}

}
