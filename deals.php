<?php
    include 'inc/header.php';
    require 'config/config.php';
    
    echo '<h4>List of deals: '.PHP_EOL.'</h4>';
     
    $output_delas = curl_exec($ch_deals);
    curl_close($ch_deals);

    $output_notes = curl_exec($ch_notes);
    curl_close($ch_notes);
     
    // Create an array from the data that is sent back from the API
    // As the original content from server is in JSON format, convert it to a PHP array
    $result_deals = json_decode($output_delas, true);

    $result_notes = json_decode($output_notes, true);

    // Check if data returned in the result is not empty
    if (empty($result_deals['data'])) {
        exit('No deals created yet'.PHP_EOL);
    }

    if (empty($result_notes['data'])) {
        exit('No notes created yet'.PHP_EOL);
    }

    // Iterate over all found deals
    foreach ($result_deals['data'] as $key => $deal) {
        $deal_title = $deal['title'];

        // Print out a deal name
        echo '<li class="list-group-item d-flex justify-content-between align-items-center bg-dark">'.($key + 1).'. '.$deal_title.PHP_EOL.'</li>';

        // Iterate over all found notes
        foreach ($result_notes['data'] as $key => $note) {
            $notes_content = $note['content'];
            $notes_deal = $note['deal'];

            if ($deal_title == $notes_deal['title']) {
                // Print out a note content
                echo '<li class="list-group-item d-flex justify-content-between align-items-center">'.$notes_content.PHP_EOL.'</li>';
            }        
        } 
    }

    include 'inc/footer.php';
