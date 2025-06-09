<?php
/*
Plugin Name: MCQS Maker
Plugin URI: https://pakstudy.xyz/product-mcqs-maker
Description: A powerful plugin to create, manage, and track MCQs for Pakistan Studies. Includes Admin and User dashboards, category management, quiz tracking, leaderboards, and user quiz history.
Version: 1.0
Author: Shahid Hussain Soomro
Author URI: https://pakstudy.xyz/
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Include required files
require_once plugin_dir_path(__FILE__) . 'includes/mcqs-db.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-dashboard.php';
require_once plugin_dir_path(__FILE__) . 'includes/user-dashboard.php';
require_once plugin_dir_path(__FILE__) . 'includes/quiz-manager.php';
require_once plugin_dir_path(__FILE__) . 'includes/settings.php';

// Activation hook to create tables
register_activation_hook(__FILE__, 'mcqs_maker_create_tables');

function mcqs_maker_create_tables() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $table_questions = $wpdb->prefix . 'mcqs_questions';
    $table_quizzes = $wpdb->prefix . 'mcqs_quizzes';
    $table_categories = $wpdb->prefix . 'mcqs_categories';
    $table_attempts = $wpdb->prefix . 'mcqs_attempts';

    dbDelta("CREATE TABLE $table_questions (
        id INT NOT NULL AUTO_INCREMENT,
        question TEXT NOT NULL,
        options TEXT NOT NULL,
        answer VARCHAR(255) NOT NULL,
        explanation TEXT,
        reference TEXT,
        category_id INT,
        difficulty ENUM('Easy','Medium','Hard') DEFAULT 'Medium',
        PRIMARY KEY (id)
    ) $charset_collate;");

    dbDelta("CREATE TABLE $table_quizzes (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        category_id INT,
        questions TEXT NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;");

    dbDelta("CREATE TABLE $table_categories (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;");

    dbDelta("CREATE TABLE $table_attempts (
        id INT NOT NULL AUTO_INCREMENT,
        user_id BIGINT NOT NULL,
        quiz_id INT NOT NULL,
        score INT,
        total INT,
        attempted_on DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;");
}

// Admin assets
add_action('admin_enqueue_scripts', 'mcqs_maker_admin_assets');
function mcqs_maker_admin_assets() {
    wp_enqueue_style('mcqs-admin-style', plugin_dir_url(__FILE__) . 'assets/css/admin-style.css');
    wp_enqueue_script('mcqs-admin-script', plugin_dir_url(__FILE__) . 'assets/js/admin-script.js', array('jquery'), null, true);
}

// User assets
add_action('wp_enqueue_scripts', 'mcqs_maker_user_assets');
function mcqs_maker_user_assets() {
    wp_enqueue_style('mcqs-user-style', plugin_dir_url(__FILE__) . 'assets/css/user-style.css');
    wp_enqueue_script('mcqs-user-script', plugin_dir_url(__FILE__) . 'assets/js/user-script.js', array('jquery'), null, true);
}
