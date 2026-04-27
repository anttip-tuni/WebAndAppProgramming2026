<?php

add_action('wp_head', function(){
    global $wpdb;

    $rowresults = $wpdb->get_results("
        SELECT name
        FROM foodsenglish
        ORDER BY name ASC

    ");

    $foods = [];

    foreach($rowresults as $row){
        $foods[] = ['name' => $row->name];
        /* Here we are looping through the results and appending to the array the name of each row 
        
        Notice that if we didnt use the square brackets to append to the array, we would just be overwriting the value of foods with the name of the current row. So this would not append but overwrite:
        
        $foods = ['name' => $row->name];
        
        */
    }/* end foreach */

    echo '<script>';

    echo 'const foods = ' . json_encode($foods) . ';'; //this line renders as const foods = [{"name":"Apple"},{"name":"Banana"},{"name":"Carrot"}]; in the HTML source code
    // . This

    echo '</script>';



});
