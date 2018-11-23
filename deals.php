<?php
    include 'inc/header.php';
     
    // Pipedrive API token
    $api_token = '68926f84300763d38ff5ea52f9f12b0039814782';

    // Pipedrive company domain
    $company_domain = 'allaboutpc-124cff';
     
    // URLs for Deals and Notes listing with $company_domain and $api_token variables
    $url_deals = 'https://'.$company_domain.'.pipedrive.com/v1/deals?api_token='.$api_token;
    $url_notes = 'https://'.$company_domain.'.pipedrive.com/v1/notes?api_token='.$api_token;

    //GET request
    $ch_deals = curl_init();
    curl_setopt($ch_deals, CURLOPT_URL, $url_deals);
    curl_setopt($ch_deals, CURLOPT_RETURNTRANSFER, true);

    $ch_notes = curl_init();
    curl_setopt($ch_notes, CURLOPT_URL, $url_notes);
    curl_setopt($ch_notes, CURLOPT_RETURNTRANSFER, true);
     
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
