<?php

add_action('admin_post_storeScore', 'handleHighScoreInput');

add_action('admin_post_nopriv_storeScore', 'handleHighScoreInput');

function handleHighScoreInput(){
    global $wpdb;
    $name = sanitize_text_field($_POST['playerName']);

    $time = floatval($_POST['playerTime']);

    $wpdb->insert(
        'highscores',
        array(
            'playerName' => $name,
            'playerTime' => $time
        ),
        array(
            '%s',
            '%f'
        )
    );

    wp_redirect(home_url());

    exit;

}