<?php
/**
* Plugin Name: Deactivate user plugin
* Plugin URI: https://github.com/rapidwebltd/deactivate-user-plugin/
* Description: Allows a user to deactive their own user account from within the WordPress login area, or via the shortcode 
* Version: 1.0
* Author: Jordan Hall
* Author URI: http://jordanhall.co.uk/
* License: MIT
*/

$jhdup_page_slug = 'deactivate_my_account';

add_action('admin_menu', 'jhdup_deactivate_my_account_menu' );

add_shortcode('jhdup_deactivate_current_user_shortcode', 'jhdup_deactivate_current_user_shortcode_handler' );

function jhdup_deactivate_my_account_menu()
{
    global $jhdup_page_slug;
    
	add_menu_page('Deactivate my account', 'Deactivate my account', 'read', $jhdup_page_slug, 'jhdup_deactivate_my_account');
}

function jhdup_deactivate_my_account() 
{
	global $jhdup_page_slug;
	
	if (isset($_GET['confirm'])) {
        jhdup_perform_deactivation_of_current_user();
        
        echo '<div class="wrap">';
        echo '<h1>Deactivate my account</h1>';
        echo '<p>Your account has been deactivated and you have been logged out.</p>';
        echo '<p><a href="/">Return to the homepage</a></p>';
        echo '</div>';
	}
	else {
        echo '<div class="wrap">';
        echo '<h1>Deactivate my account</h1>';
        echo '<p>Are you sure you want to delete your account?</p>';
        echo '<p><a href="?page='.$jhdup_page_slug.'&confirm">Yes, deactivate my account</p>';
        echo '<p><a href="./">No, return to the dashboard</p>';
        echo '</div>';
	}
}

function jhdup_deactivate_current_user_shortcode_handler()
{
    jhdup_perform_deactivation_of_current_user();
    
    $return = '';
    $return .= '<p>Your account has been deactivated and you have been logged out.</p>';
    $return .= '<p><a href="/">Return to the homepage</a></p>';
    
    return $return;
}

function jhdup_perform_deactivation_of_current_user()
{
    global $wpdb;
    global $current_user;
    
    get_currentuserinfo();
    
    $dectivation_suffix = '___jhdup'.rand(0, 99999);
    
    $new_data = array(  'user_login' => $current_user->user_login.$dectivation_suffix,
                        'user_email' => $current_user->user_email.$dectivation_suffix
                     );
    
    $wpdb->update($wpdb->users, $new_data, array('ID' => $current_user->ID));
    
    $wpdb->update($wpdb->posts, array('post_status' => 'draft'), array('post_author' => $current_user->ID));
    
    wp_logout();
}
