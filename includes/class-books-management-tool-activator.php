<?php
 
/**
 * Fired during plugin activation
 *
 * @link       http://smartcoder.blogspot.com/
 * @since      1.0.0
 *
 * @package    Books_Management_Tool
 * @subpackage Books_Management_Tool/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Books_Management_Tool
 * @subpackage Books_Management_Tool/includes
 * @author     Online Web Tutor <smartcoder@gmail.com>
 */
class Books_Management_Tool_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate() {

		global $wpdb;

		if($wpdb->get_var("SHOW tables like '".$this->wp_smc_tbl_books()."'") != $this->wp_smc_tbl_books()){

			// dynamic table generating code...
		 $table_query = "CREATE TABLE `".$this->wp_smc_tbl_books()."` (
								`id` int(11) NOT NULL AUTO_INCREMENT,
								`name` varchar(150) DEFAULT NULL,
								`amount` int(11) DEFAULT NULL,
								`description` text,
								`book_image` varchar(200) DEFAULT NULL,
								`publication` varchar(150) DEFAULT NULL,
								`email` varchar(150) DEFAULT NULL,
								`shelf_id` INT NULL,
								`status` int(11) NOT NULL DEFAULT '1',
								`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
								PRIMARY KEY (`id`)
							 ) ENGINE=InnoDB DEFAULT CHARSET=latin1"; // table create query

		 require_once (ABSPATH.'wp-admin/includes/upgrade.php');
		 dbDelta($table_query);
		}

	    // table for create shelf
	    if($wpdb->get_var("Show tables like '".$this->wp_smc_tbl_book_shelf()."'") != $this->wp_smc_tbl_book_shelf()){

	    	$shelf_table = "CREATE TABLE `".$this->wp_smc_tbl_book_shelf()."` (
					 `id` int(11) NOT NULL AUTO_INCREMENT,
					 `shelf_name` varchar(150) NOT NULL,
					 `capacity` int(11) NOT NULL,
					 `shelf_location` varchar(200) NOT NULL,
					 `status` int(11) NOT NULL DEFAULT '1',
					 `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
					 PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=latin1";

			require_once (ABSPATH.'wp-admin/includes/upgrade.php');
		    dbDelta($shelf_table);

		    $insert_query = "INSERT into ".$this->wp_smc_tbl_book_shelf()." (shelf_name, capacity, shelf_location, status) VALUES 
		        ('Shelf 1', 230, 'Left Cornor', 1), 
		        ('Shelf 2', 300, 'Right Cornor', 1), 
		        ('Shelf 3', 100, 'Center Top', 1)";

		    $wpdb->query($insert_query);
	    }

	    // create page on plugin activation
	    // wp_posts
	    $get_data =$wpdb->get_row(
	    	$wpdb->prepare(
	    		"SELECT * from ".$wpdb->prefix."posts WHERE post_name = %s", 'book_tool'
	    	)
	    );
 
	    if(!empty($get_data)){
	    	// already we have data with this post name
	    }else{
	    	// create page
	    	$post_arr_data = array(
	    		"post_title" => "Book Tool",
	    		"post_name" => "book_tool",
	    		"post_status" => "publish",
	    		"post_author" => 1,
	    		"post_content" => "Simple page content of Book Tool",
	    		"post_type" => "page"
	    	);

	    	wp_insert_post($post_arr_data);
	    }

	}

	public function wp_smc_tbl_books(){
		global $wpdb;
		return $wpdb->prefix."smc_tbl_books"; // $wpdb->prefix => wp_
	}

	public function wp_smc_tbl_book_shelf(){

		global $wpdb;
		return $wpdb->prefix."smc_tbl_book_shelf";
	}

}
