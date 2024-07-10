<?php

/** 

 * Plugin Name: My Plugin
 * Description: This is a test plugin
 * Version: 1.1.0
 * AUthor: Pathik Patel
 * Author URI: https://www.flipkart.com/


 */
if (!defined('ABSPATH')) {
    header("Location: /customeplgin");
    die("can't Access");
}



//------------------------------------------Start Create Table through Automatic by Plugin---------------------------------------------------------

function my_plugin_activation()
{
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix . 'emp';
    //   CREATE TABLE `customeplugin`.`wp_emp` (`ID` INT NOT NULL AUTO_INCREMENT , `name` 
    //   VARCHAR(50) NOT NULL , `email` VARCHAR(50) NOT NULL , `status` BOOLEAN NOT NULL 
    //   , PRIMARY KEY (`ID`)) ENGINE = InnoDB;

    // Create Table Query
    $q = "CREATE TABLE IF NOT EXISTS `$wp_emp` (`ID` INT NOT NULL AUTO_INCREMENT , `name` 
        VARCHAR(50) NOT NULL , `email` VARCHAR(50) NOT NULL , `status` BOOLEAN NOT NULL , 
        `phone` VARCHAR(50) NOT NULL ,`username` VARCHAR(50) NOT NULL,`city` VARCHAR(50) NOT NULL,
        PRIMARY KEY (`ID`)) ENGINE = InnoDB; ";
    $wpdb->query($q);
    
    // insert Data Query
    
    //  $q = "INSERT INTO `$wp_emp` (`name`,`email`,`status`) VALUES ('Pathik', 'p4pathik424@gmail.com',1);";
    $data = array(
        'name' => 'NIrav',
        'email' => 'niravp1342@gmail.com',
        'status' => 1,
        'phone' => 9904360737,
        'username' => 'nirav1342',
        'city' => 'ahmedabad'
        
        
    );
    $wpdb->insert($wp_emp, $data);
}
register_activation_hook(__FILE__, 'my_plugin_activation');

//------------------------------------------End Create Table through Automatic by Plugin---------------------------------------------------------



//------------------------------------------Start Drop Table through Automatic by Plugin---------------------------------------------------------

function my_plugin_deactivation()
{
    // Delete Table
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix . 'emp';
    
    //if Delete Table Karvu hoy to 
    $q = "DROP TABLE `$wp_emp`";
    
    //if TRUNCATE Table Karvu hoy to 
    // $q = "TRUNCATE `$wp_emp`";
    
    
    // $q = 
    $wpdb->query($q);
}
register_deactivation_hook(__FILE__, 'my_plugin_deactivation');

//------------------------------------------End Drop Table through Automatic by Plugin---------------------------------------------------------

// shorcode create thase
// function my_shortcode($atts)
// {
    //     array_change_key_case((array) $atts, CASE_LOWER);
    
    //     $atts = shortcode_atts(array(
        //         'type' => 'img_gallery.php', 'slider.php' // [customeplugin type = "slider"] short code ma je lakhis e avse
//     ), $atts);

//     // File Attached Kari
//     include $atts['type'] . '.php';

//     // return 'Hello Pathik'. $atts['msg'];


// }
// add_shortcode('customeplugin', 'my_shortcode');


//js file include karva mate


//------------------------------------------Start JS Attached by Custom Plugin---------------------------------------------------------

function my_custom_scripts()
{
   
    
    // Paths to Bootstrap CSS and JS
    $bootstrap_css = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css';
    $popper_js = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js';
    $bootstrap_js = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js';
    
    // Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap-css', $bootstrap_css);

    // Enqueue Popper.js
    wp_enqueue_script('popper-js', $popper_js, array('jquery'), null, true);


 

    
    // Enqueue Bootstrap JS
    wp_enqueue_script('bootstrap-js', $bootstrap_js, array('jquery', 'popper-js'), null, true);
    $path_js = plugins_url('js/main.js', __FILE__);
    $path_style = plugins_url('js/main.js', __FILE__);
    $dep = array('jquery');
    $ver = filemtime(plugin_dir_path(__FILE__) . 'js/main.js');
    // $ver1 = filemtime(plugin_dir_path(__FILE__) . 'js/user/deleteuser.js');
    $ver_style = filemtime(plugin_dir_path(__FILE__) . 'css/style.css');
    $is_login = is_user_logged_in() ? 1 : 0;
    
  
    
    // wp_enqueue_script('my-ajax-script', get_template_directory_uri() . '/js/my-ajax-script.js', array('jquery'), null, true);

    wp_enqueue_script('my-custom-js', $path_js, $dep, $ver, true);
    wp_add_inline_script('my-custom-js', 'var ajaxUrl =  "' . admin_url('admin-ajax.php') . '";', 'before');
    


   
}

add_action('wp_enqueue_scripts', 'my_custom_scripts');
add_action('admin_enqueue_scripts', 'my_custom_scripts');

function load_js_assets()
{
    $path_user = plugins_url('js/user/deleteuser.js', __FILE__);

    if (is_page (83)){
        wp_enqueue_script('my-user-js', $path_user,array('jquery'), '',false);
        
    }
}

add_action('wp_enqueue_scripts','load_js_assets');

// AJax ajax_object Custome when i conncet JS by custome js/user/deleteuser.js
function enqueue_delete_user_script() {
    wp_enqueue_script('deleteuser-js', get_template_directory_uri() . '/js/user/deleteuser.js', array('jquery'), '1.0', true);

    // Localize the script with new data
    wp_localize_script('deleteuser-js', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_delete_user_script');








//------------------------------------------End JS Attached by Custom Plugin---------------------------------------------------------



//------------------------------------------Start Shorcut for read data-------------------------------------------------------------------
function my_shortcode()
{
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix . 'emp';
    
    $q = "SELECT * FROM `$wp_emp` WHERE `status` = 0;";
    $result = $wpdb->get_results($q);
    
    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";

    ob_start();
    ?>

    <table>
        <thead>

            <td>ID</td>
            <td>NAME</td>
            <td>EMAIL</td>
            <td>status</td>
            <td>phone</td>
            <td>username</td>
            <td>city</td>
            
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) :
                ?>
                <tr>
                    <td><?php echo $row->ID; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->status; ?></td>
                    <td><?php echo $row->phone; ?></td>
                    <td><?php echo $row->username; ?></td>
                    <td><?php echo $row->city; ?></td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>
    <?php
    $html = ob_get_clean();
    
    return $html;
}
add_shortcode('customeplugin', 'my_shortcode');


//------------------------------------------End Shorcut for read data-------------------------------------------------------------------


//------------------------------------------STart My Post Read data------------------------------------------------------------------------
function my_posts()
{
    $args = array(

        //   https://developer.wordpress.org/reference/classes/wp_query/
        'post_type' => 'post'
        //    'posts_per_page' => 5,
        //    'orderby' => 'ID'
        //    'offset' => 2,
        //    'order' => 'ASC'
        //    'category_name' => 'Cat C'     // koi Category thi search karvu hoy to           
        //    's' => 'Dog Smell'           // koi word thi search karvu hoy to
    );
    $query = new Wp_Query($args);
    
    ob_start();
    if ($query->have_posts());
?>
    <ul>
        <?php
        while ($query->have_posts()) {
            $query->the_post();
            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a>- >' . get_the_content() . '</li>';
        }
        ?>
    </ul>
    <?php echo wp_pagenavi(); ?>
    
    
    
    <?php


wp_reset_postdata();
    $html = ob_get_clean();
    return $html;
}
add_shortcode('my-posts', 'my_posts');

//------------------------------------------End My Post Read data------------------------------------------------------------------------

// post ketli var read thai che ena mate
// function head_fun()
// {
//     if(is_single()) {
//         global $post;
//         echo $post->ID;
//         $views = get_post_meta($post->ID, 'views', true);

//         if($views == '') {
//             add_post_meta($post->ID, 'views', 1);
//         } else {
//             $views++;
//             update_post_meta($post->ID . 'views', $views);
//             }
//             echo get_post_meta($post->ID, 'views', true);
//         // return $views;
//             }
//             }

// add_action('wp_head', 'head_fun');


//----------------------------------------------------------Start My cutome Page connection ------------------------------------------------------

// menu add karva mate 



function my_user_page_func()
{
    // echo 'hi';
    include 'admin/my-user-page.php';
}

function my_plugin_page_func()
{
    // echo 'hi';
    include 'admin/main-page.php';
}
function my_plugin_subpage_fun()
{
    // echo 'hi';
    include 'admin/main-page.php';
}
function my_table_data()
{
    include('admin/main-page.php');
}

//----------------------------------------------------------End Mycutome Page Connection------------------------------------------------------


//----------------------------------------------------------STart Mycutome Page Add in Admin------------------------------------------------------

function my_plugin_menu()
{
    
    // Main Menu My plugin ::
    add_menu_page('My Plugin Page', 'My Plugin Page', 'manage_options', 'my-plugin-page', 'my_plugin_page_func', '', 6);
    

    //https://www.youtube.com/watch?v=nCgiEe2sOzE&list=PLa9NMvQUMD5c85kY0q6X15RTM8zm0s9H7&index=9
    // My Plugin Page :  e page che
    // title : admin page par list ma name su joi e che
    // manage_option : only admin joi sakse
    // my_plugin_page : slug che
    // my-plugin-page-func : function name {game te api sako}
    // '' e icon mate che jo a rakhaso to default icon wordpress nu hase e j avi jase
    // 6 e position che kya dekhadvu che
    
    
    // sub menu my plugin ::
    
    add_submenu_page('my-plugin-page', 'All Emp', 'All Emp', 'manage_options', 'my-plugin-page', 'my_plugin_page_func');
    
    add_submenu_page('my-plugin-page', 'My Plugin Sub Page', 'My Plugin Sub Page', 'manage_options', 'my-plugin-subpage', 'my_plugin_subpage_fun');
    
    // my-plugin-page : menu page ma je slug ni andar joi che e  
    
    // User Menu
    
    add_menu_page('My User Page', 'My User Page', 'manage_options', 'my-user-page', 'my_user_page_func', '', 6);
    
    // sub menu my plugin ::
    add_submenu_page('my-user-page', 'All User', 'All User', 'manage_options', 'my-user-page', 'my_user_page_func');
    
    add_submenu_page('my-user-page', 'My User Sub Page', 'My User Sub Page', 'manage_options', 'my-user-subpage', 'my_user_subpage_fun');
    
}
add_action('admin_menu', 'my_plugin_menu');

//----------------------------------------------------------End Mycutome Page Add in Admin------------------------------------------------------

//----------------------------------------------------------Start My Search Function--------------------------------------------------------------

// AJax Calling

add_action('wp_ajax_my_search_func', 'my_search_func');
function my_search_func()
{
    // echo 'hi';
    
    // echo $search_term;
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix . 'emp';
    $search_term = $_POST['search_term'];
    
    
    if (!empty($search_term)) {
        
        // multiple section serch email phone name

        $q = "SELECT * FROM `$wp_emp` WHERE
         `name` LIKE '%" . $search_term . "%'
          OR `email` LIKE '%" . $search_term . "%'
          OR `status` LIKE '%" . $search_term . "%'
          OR `phone` LIKE '%" . $search_term . "%'
          OR `username` LIKE '%" . $search_term . "%'
          OR `city` LIKE '%" . $search_term . "%'
          ;";
        } else {
            $q = "SELECT * FROM `$wp_emp`;";
        }
        $results = $wpdb->get_results($q);
        
        
        // echo '<pre>';
        // print_r($results);
        // echo '</pre>';
        
        ob_start();
        
        foreach ($results as $row) :
            ?>
        <tr>
            <td><?php echo $row->ID; ?></td>
            <td><?php echo $row->name; ?></td>
            <td><?php echo $row->email; ?></td>
            <td><?php echo $row->status; ?></td>
            <td><?php echo $row->phone; ?></td>
            <td><?php echo $row->username; ?></td>
            <td><?php echo $row->city; ?></td>
        </tr>
        <?php
    endforeach;
    
    echo ob_get_clean();
    
    
    wp_die();
}



add_shortcode('my-data', 'my_table_data');
add_shortcode('my-userdata', 'my_user_page_func');



//----------------------------------------------------------End My Search Function--------------------------------------------------------------




// for custome post type 

//-----------------------------------------------------Start Register Function add by default functionality in Wordpress-------------------
function register_my_cpt()
{
    $labels = array(
        'name' => 'Cars',
        'singular_name' => 'Car'
    );
    $supports = array('title', 'editor', 'thumbnail', 'comments', 'excerpts');
    $options = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'cars'),
        'show_in_rest' => true,
        'supports' => $supports,
        'taxonomies' => array('car_types'),
        'publicly_queryable' => true,
        
        
    );
    
    register_post_type('cars', $options);
}
add_action('init', 'register_my_cpt');

function register_car_types()
{
    
    $labels = array(
        'name' => 'Car Type',
        'singular_name' => 'Car Type'
    );
    
    
    $options = array(
        'labels' => $labels,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'car-type'),
        'show_in_rest' => true
    );
    register_taxonomy('car-type', array('cars'), $options);
}
add_action('init', 'register_car_types');


//-----------------------------------------------------End Register Function add by default functionality in Wordpress-------------------


//-----------------------------------------------------STart Register and Login form Attached-----------------------------------------------------

function my_register_form()
{
    ob_start();
    include 'public/register.php';
    return ob_get_clean();
}
add_shortcode('my-register-form', 'my_register_form');



// function my_ajaxregister_form()
// {
    //     ob_start();
    //     include 'public/ajaxregister.php';
    //     return ob_get_clean();
    // }
    // add_shortcode('my-ajaxregister-form','my_ajaxregister_form');
    
    function my_login_form()
{
    ob_start();
    include 'public/login.php';
    return ob_get_clean();
}
add_shortcode('my-login-form', 'my_login_form');


//-----------------------------------------------------End Register and Login form Attached-----------------------------------------------------


//-----------------------------------------------------Start Page Login Relodation After Submit data---------------------------------------------
function my_login()
{
    if (isset($_POST['user_login'])) {
        
        $username = esc_sql($_POST['username']);
        $pass = esc_sql($_POST['pass']);

        $credentials = array(
            'user_login' => $username,
            'user_password' => $pass,
            
        );
        $user = wp_signon($credentials);
        
        if (!is_wp_error($user)) {
            
            // echo '<pre>';
            // print_r($user);
            // echo '</pre>';
            
            if ($user->roles[0] == 'administrator') {
                wp_redirect(admin_url());
                exit;
            } else {
                wp_redirect(site_url('profile'));
                exit;
            }
        } else {
            echo $user->get_error_message();
        }
    }
}
add_action('template_redirect', 'my_login');

//-----------------------------------------------------End Page Login Relodation After Submit data---------------------------------------------


//----------------------------------------------------Start Profile Page Connect------------------------------------------------------------
function my_profile()
{
    
    ob_start();
    
    include 'public/profile.php';
    return ob_get_clean();
}
add_shortcode('my-profile', 'my_profile');



//----------------------------------------------------End Profile Page Connect------------------------------------------------------------


//--------------------------------------------------Start Insert Query Through Ajax---------------------------------------------------------
// main.php ma connection apyu 



// Ajax Insert Emp Table

add_action('wp_ajax_contact_us', 'ajax_contact_us');
function ajax_contact_us()
{
    $arr = [];
    wp_parse_str($_POST['contact_us'], $arr);
    // echo '<pre>';
    // print_r($arr);
    // echo '</pre>';

    // databse connection apyu
    global $wpdb, $table_prefix;
    $table = $table_prefix . 'emp';
    $result = $wpdb->insert($table, [

        "name" => $arr['name'],
        "email" => $arr['email'],
        "status" => $arr['status'],
        "phone" => $arr['phone'],
        "username" => $arr['username'],
        "city" => $arr['city'],
    ]);
    wp_send_json_success($result);
}


// Ajax Insert User Table

add_action('wp_ajax_user_us', 'ajax_user_us');

function ajax_user_us() {
    // Ensure this is an AJAX request
    if (!defined('DOING_AJAX') || !DOING_AJAX) {
        wp_send_json_error('Not an AJAX request.');
    }
    
    $arr = [];
    wp_parse_str($_POST['user_us'], $arr);
    
    // Check for required fields
    if (empty($arr['display_name']) || empty($arr['user_login']) || empty($arr['user_nicename']) || empty($arr['user_email']) || empty($arr['user_pass'])) {
        wp_send_json_error('Missing required fields.');
    }
    
    // Sanitize and validate input
    $display_name = sanitize_text_field($arr['display_name']);
    $user_login = sanitize_user($arr['user_login']);
    $user_nicename = sanitize_text_field($arr['user_nicename']);
    $user_email = sanitize_email($arr['user_email']);
    $user_pass = wp_hash_password($arr['user_pass']); // Hash the password
    
    // Validate email
    if (!is_email($user_email)) {
        wp_send_json_error('Invalid email address.');
    }
    
    // Check if username or email already exists
    if (username_exists($user_login) || email_exists($user_email)) {
        wp_send_json_error('Username or email already exists.');
    }
    
    global $wpdb, $table_prefix;
    $table = $table_prefix . 'users';
    $result = $wpdb->insert($table, [
        "display_name" => $display_name,
        "user_login" => $user_login,
        "user_nicename" => $user_nicename,
        "user_email" => $user_email,
        "user_pass" => $user_pass,
    ]);
    
    if ($result) {
        wp_send_json_success('User registered successfully.');
    } else {
        wp_send_json_error('User registration failed.');
    }
}
//--------------------------------------------------End Insert Query Through Ajax---------------------------------------------------------



//---------------------------------------------------Start Url Validation Like Middleware ------------------------------------------------------


// logout user login user mate je page access che ena mate
// validation apyu jo user login hase to url thi login page nai khule
function my_check_redirect()
{
    
    $is_user_logged_in = is_user_logged_in();
    
    if ($is_user_logged_in && (is_page('login') || is_page('register'))) {
        wp_redirect(site_url('profile'));
        exit;
    } elseif (!$is_user_logged_in && is_page('profile')) {
        wp_redirect(site_url('login'));
        exit;
    }
}
add_action('template_redirect', 'my_check_redirect');

function redirect_after_logout()
{
    
    wp_redirect(site_url('login'));
    exit;
}
add_action('wp_logout', 'redirect_after_logout');

//---------------------------------------------------End Url Validation Like Middleware ------------------------------------------------------



//--------------------------------------------------Start Delete Data Through Ajax---------------------------------------------------------------



// start delete data ajax Emp Table
function ajax_delete_entry()
{
    // Check if the ID parameter is set
    if (isset($_POST['ID'])) {
        // Sanitize and retrieve the ID of the entry to be deleted
        $entry_id = intval($_POST['ID']);
        
        // Database connection
        global $wpdb, $table_prefix;
        $table = $table_prefix . 'emp';
        
        // Delete the entry from the database
        $result = $wpdb->delete($table, array('ID' => $entry_id));

        // Check if deletion was successful
        if ($result !== false) {
            // Return success message
            wp_send_json_success('Entry deleted successfully.');
        } else {
            // Return error message
            wp_send_json_error('Failed to delete entry.');
        }
    } else {
        // Return error if ID parameter is not set
        wp_send_json_error('ID parameter is missing.');
    }
}
add_action('wp_ajax_delete_entry', 'ajax_delete_entry');




// start user delete data ajax
function ajax_user_delete_entry()
{
    // Check if the ID parameter is set
    if (isset($_POST['ID'])) {
        // Sanitize and retrieve the ID of the entry to be deleted
        $entry_id = intval($_POST['ID']);

        // Database connection
        global $wpdb, $table_prefix;
        $table = $table_prefix . 'users';

        // Delete the entry from the database
        $result = $wpdb->delete($table, array('ID' => $entry_id));

        // Check if deletion was successful
        if ($result !== false) {
            // Return success message
            wp_send_json_success('Entry deleted successfully.');
        } else {
            // Return error message
            wp_send_json_error('Failed to delete entry.');
        }
    } else {
        // Return error if ID parameter is not set
        wp_send_json_error('ID parameter is missing.');
    }
}
add_action('wp_ajax_user_delete_entry', 'ajax_user_delete_entry');




//--------------------------------------------------End Delete Data Through Ajax---------------------------------------------------------------


//--------------------------------------------------Start Update Data Through Ajax---------------------------------------------------------------



// start update data ajax Emp Table

function ajax_update_entry()
{
    if (isset($_POST['ID'])) {
        $entry_id = intval($_POST['ID']);
        
        global $wpdb, $table_prefix;
        $table = $table_prefix . 'emp';
        
        $entry = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE ID = %d", $entry_id), ARRAY_A);
        
        if ($entry) {
            wp_send_json_success($entry);
        } else {
            wp_send_json_error('Entry not found.');
        }
    } else {
        wp_send_json_error('Required parameters are missing.');
    }
}
add_action('wp_ajax_update_entry', 'ajax_update_entry');

function ajax_process_update_entry()
{
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix . 'emp'; // Define $wp_emp here
    
    // Handle AJAX request for updating user data
    if (isset($_POST['action']) && $_POST['action'] == 'process_update_entry') {
        $id = $_POST['ID'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $status = $_POST['status'];
        $phone = $_POST['phone'];
        $username = $_POST['username'];
        $city = $_POST['city'];
        
        $wpdb->update(
            $wp_emp,
            array(
                'name' => $name,
                'email' => $email,
                'status' => $status,
                'phone' => $phone,
                'username' => $username,
                'city' => $city
            ),
            array('ID' => $id)
        );
        wp_die();
    }
}
add_action('wp_ajax_process_update_entry', 'ajax_process_update_entry');


// end update data ajax

//--------------------------------------------------End Update Data Through Ajax---------------------------------------------------------------

//--------------------------------------------------Start Read Data Through Ajax---------------------------------------------------------------


// start read data ajax Emp Table

add_action('wp_ajax_fetch_table_data', 'fetch_table_data_callback');
add_action('wp_ajax_nopriv_fetch_table_data', 'fetch_table_data_callback');



function fetch_table_data_callback()
{
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix . 'emp';
    
    $q = "SELECT * FROM `$wp_emp`;";
    $result = $wpdb->get_results($q);
    
    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Document</title>
    </head>

    <body>
        
        
        <table class="wp-list-table widefat fixed striped table-view-list posts">
            
            <div class="wrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Phone</th>
                        <th>Username</th>
                        <th>City</th>
                        
                        <th style="text-align :center;">User Action</th>
                        <th style="text-align :center;">Action</th>
                    </tr>
                </thead>
                <tbody id="my-table-result">
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td><?php echo $row->ID; ?></td>
                            <td><?php echo $row->name; ?></td>
                            <td><?php echo $row->email; ?></td>
                            <td><?php echo $row->status; ?></td>
                            <td><?php echo $row->phone; ?></td>
                            <td><?php echo $row->username; ?></td>
                            <td><?php echo $row->city; ?></td>
                            
                            
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action on User </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Active User</a>
                                            <a class="dropdown-item" href="#">De-active User</a>
                                            <!-- <a class="dropdown-item" href="#">Something else here</a> -->
                                        </div>
                                </div>
                            </td>
                            <td class="cmn_btn">
                                <button class="btn-update" id="btn-update" data-id="<?php echo $row->ID; ?>">Update</button>
                                <button class="delete-button" value="<?php echo $row->ID; ?>">Delete</button>
                            </td>
                        </tr>

                        <?php endforeach; ?>
                    </tbody>
        </table>

    </body>

    </html>
    <style>
        .dropdown button#dropdownMenuButton {
            width: 100%;
        }
        
        tr {
            /* display: flex; */
            align-items: center;
            /* justify-content: space-between; */
        }
        
        .cmn_btn {
            /* display: flex; Use flexbox to align items */
            flex-direction: column;
            /* Arrange items in a column */
            align-items: center;
            /* Center align items horizontally */
        }
        
        .cmn_btn button {
            margin-bottom: 10px;
            /* Margin between buttons */
            padding: 10px 20px;
            /* Padding inside the buttons */
            border: none;
            /* Remove default border */
            cursor: pointer;
            /* Cursor style on hover */
            border-radius: 5px;
            /* Rounded corners */
            font-size: 16px;
            /* Font size */
            transition: background-color 0.3s ease;
            /* Smooth transition for background color */
            width: 100px;
            /* Set width for the buttons */
        }
        
        .btn-update {
            background-color: #4CAF50;
            /* Green background */
            color: white;
            /* White text */
        }
        
        .btn-update:hover {
            background-color: #45a049;
            /* Darker green on hover */
        }

        .delete-button {
            background-color: #f44336;
            /* Red background */
            color: white;
            /* White text */
        }
        
        .delete-button:hover {
            background-color: #da190b;
            /* Darker red on hover */
        }
    </style>

<?php
    echo ob_get_clean();
    wp_die();
}



// star read data ajax User Table

add_action('wp_ajax_fetch_user_table_data', 'fetch_user_table_data_callback');
add_action('wp_ajax_nopriv_fetch_user_table_data', 'fetch_user_table_data_callback');



function fetch_user_table_data_callback()
{
    global $wpdb, $table_prefix;
    $wp_users = $table_prefix . 'users';

    $q = "SELECT * FROM `$wp_users`;";
    $result = $wpdb->get_results($q);

    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
            <title>Document</title>
    </head>
    
    <body>
        
        
        <table class="wp-list-table widefat fixed striped table-view-list posts">
            
            <div class="wrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Display Name</th>
                        <th>User Login</th>
                        <th>User Nicename</th>
                        <th>User Email</th>
               
                        
                        
            
                        <th style="text-align :center;">Action</th>
                    </tr>
                </thead>
                <tbody id="my-table-result">
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td><?php echo $row->ID; ?></td>
                            <td><?php echo $row->display_name; ?></td>
                            <td><?php echo $row->user_login; ?></td>
                            <td><?php echo $row->user_nicename; ?></td>
                            <td><?php echo $row->user_email; ?></td>
                
                        
                            <td class="cmn_btn">
                                <button class="btn-update" id="btn-update" data-id="<?php echo $row->ID; ?>">Update</button>
                                <button class="delete-button" value="<?php echo $row->ID; ?>">Delete</button>
                            </td>
                        </tr>
                        
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </body>
            
            </html>
            <style>
                .dropdown button#dropdownMenuButton {
                    width: 100%;
                }
                
                tr {
                    /* display: flex; */
                    align-items: center;
                    /* justify-content: space-between; */
                }
                
                .cmn_btn {
                    /* display: flex; Use flexbox to align items */
            flex-direction: column;
            /* Arrange items in a column */
            align-items: center;
            /* Center align items horizontally */
        }

        .cmn_btn button {
            margin-bottom: 10px;
            /* Margin between buttons */
            padding: 10px 20px;
            /* Padding inside the buttons */
            border: none;
            /* Remove default border */
            cursor: pointer;
            /* Cursor style on hover */
            border-radius: 5px;
            /* Rounded corners */
            font-size: 16px;
            /* Font size */
            transition: background-color 0.3s ease;
            /* Smooth transition for background color */
            width: 100px;
            /* Set width for the buttons */
        }

        .btn-update {
            background-color: #4CAF50;
            /* Green background */
            color: white;
            /* White text */
        }

        .btn-update:hover {
            background-color: #45a049;
            /* Darker green on hover */
        }

        .delete-button {
            background-color: #f44336;
            /* Red background */
            color: white;
            /* White text */
        }
        
        .delete-button:hover {
            background-color: #da190b;
            /* Darker red on hover */
        }
    </style>

<?php
    echo ob_get_clean();
    wp_die();
}


// functions.php or your custom plugin file






// end  user read data ajax

//--------------------------------------------------End Read Data Through Ajax---------------------------------------------------------------



//------
