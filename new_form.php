<?php

/*
 * Plugin Name:      New Form
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Farhad Hossen
 * Author URI:        https://farhadhossen.com/
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }
    function new_form(){
        return<<<HTML
        <form method="post action">
    <p><label for="title">Post Title</label></p>
    <p><input type="text" id="title" name="title" required></p>
    <p><label for="content">Post Content</label> </p>
    <p><textarea id="content" name="content" rows="12" cols="48" required></textarea>
    <p><label for="name">Your Name</label> </p>
    <p><input type="text" id="name" name="name" required></p>
    <p><label for="email">Your Email Address</label> </p>
    <p><input type="email" id="email" name="email" required></p>
    <p><input type="submit" name="submit" value="Submit"></p>
    </form>
    HTML;
    }
    add_shortcode( 'form', 'new_form' );
    add_action( 'init', 'post_form_shortcode' );

    function post_form_shortcode() {
      if ( isset( $_POST['post_form_submit'] ) ) {
       
        if ( wp_verify_nonce( $_POST['post_form_nonce'], 'post_form_action' ) ) {
          
          $post_title = sanitize_text_field( $_POST['post_title'] );
          $post_content = sanitize_textarea_field( $_POST['post_content'] );
          $user_name = sanitize_text_field( $_POST['user_name'] );
          $user_email = sanitize_email( $_POST['user_email'] );
          if ( ! empty( $post_title ) && ! empty( $post_content ) && ! empty( $user_name ) && ! empty( $user_email ) ) {
            $user_id = username_exists( $user_email );
            if ( ! $user_id ) {
              $user_id = wp_create_user( $user_email, wp_generate_password(), $user_email );
            }
        }
    }
}
}
