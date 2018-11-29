<?php
    include 'inc/header.php';
    require 'config/config.php';

    echo '<h4>List of persons: '.PHP_EOL.'</h4>';
     
    $output_persons = curl_exec($ch_persons);
    curl_close($ch_persons);

    $output_notes = curl_exec($ch_notes);
    curl_close($ch_notes);
     
    // Create an array from the data that is sent back from the API
    // As the original content from server is in JSON format, convert it to a PHP array
    $result_persons = json_decode($output_persons, true);

    $result_notes = json_decode($output_notes, true);

    // Check if data returned in the result is not empty
    if (empty($result_persons['data'])) {
        exit('No persons created yet'.PHP_EOL);
    }

    if (empty($result_notes['data'])) {
        exit('No notes created yet'.PHP_EOL);
    }

    // Iterate over all found persons
    foreach ($result_persons['data'] as $key => $person) {
        $person_name = $person['name'];

        // Print out a person name
        echo '<li class="list-group-item d-flex justify-content-between align-items-center bg-dark">'.($key + 1).'. '.$person_name.PHP_EOL.'</li>';

        // Iterate over all found notes
        foreach ($result_notes['data'] as $key => $note) {
            $notes_content = $note['content'];
            $notes_person = $note['person'];

            if ($person_name == $notes_person['name']) {
                // Print out a note content
                echo '<li class="list-group-item d-flex justify-content-between align-items-center">'.$notes_content.PHP_EOL.'</li>';
            }        
        } 
    }

    include 'inc/footer.php';