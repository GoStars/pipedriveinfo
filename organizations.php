<?php
    include 'inc/header.php';
    require 'config/config.php';

    echo '<h4>List of organizations: '.PHP_EOL.'</h4>';
     
    $output_org = curl_exec($ch_org);
    curl_close($ch_org);

    $output_notes = curl_exec($ch_notes);
    curl_close($ch_notes);
     
    // Create an array from the data that is sent back from the API
    // As the original content from server is in JSON format, convert it to a PHP array
    $result_org = json_decode($output_org, true);

    $result_notes = json_decode($output_notes, true);

    // Check if data returned in the result is not empty
    if (empty($result_org['data'])) {
        exit('No organizations created yet'.PHP_EOL);
    }

    if (empty($result_notes['data'])) {
        exit('No notes created yet'.PHP_EOL);
    }

    // Iterate over all found organizations
    foreach ($result_org['data'] as $key => $organization) {
         $organization_name = $organization['name'];

        // Print out a organization name
        echo '<li class="list-group-item d-flex justify-content-between align-items-center bg-dark">'.($key + 1).'. '.$organization_name.PHP_EOL.'</li>';

        // Iterate over all found notes
        foreach ($result_notes['data'] as $key => $note) {
            $notes_content = $note['content'];
            $notes_org = $note['organization'];

            if ($organization_name == $notes_org['name']) {
                // Print out a note content
                echo '<li class="list-group-item d-flex justify-content-between align-items-center">'.$notes_content.PHP_EOL.'</li>';
            }        
        } 
    }

    include 'inc/footer.php';
