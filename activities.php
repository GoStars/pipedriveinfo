<?php
    include 'inc/header.php';
    require 'config/config.php';
     
    echo '<h4>List of activities: '.PHP_EOL.'</h4>';
     
    $output_activ = curl_exec($ch_activ);
    curl_close($ch_activ);
     
    // Create an array from the data that is sent back from the API
    // As the original content from server is in JSON format, convert it to a PHP array
    $result_activ = json_decode($output_activ, true);

    // Check if data returned in the result is not empty
    if (empty($result_activ['data'])) {
        exit('No activities created yet'.PHP_EOL);
    }

    // Iterate over all found activities
    foreach ($result_activ['data'] as $key => $activity) {
        $activity_subject = $activity['subject'];
        $activity_organization = $activity['org_name'];
        $activity_person_name = $activity['person_name'];

        // If organization and contact person not empty show them
        if (!empty($activity_organization) && !empty($activity_person_name)) {
            echo '<li class="list-group-item d-flex justify-content-between align-items-center bg-dark">'.($key + 1).'. '.$activity_subject.' ('.$activity_organization.', '.$activity_person_name.') '.PHP_EOL.'</li>';
        } else if (!empty($activity_organization)) { // If organization not empty show it
            echo '<li class="list-group-item d-flex justify-content-between align-items-center bg-dark">'.($key + 1).'. '.$activity_subject.' ('.$activity_organization.') '.PHP_EOL.'</li>';
        } else if (!empty($activity_person_name)) { // If contact person not empty show it
            echo '<li class="list-group-item d-flex justify-content-between align-items-center bg-dark">'.($key + 1).'. '.$activity_subject.' ('.$activity_person_name.') '.PHP_EOL.'</li>';
        } else {
            // Print out activity subject
            echo '<li class="list-group-item d-flex justify-content-between align-items-center bg-dark">'.($key + 1).'. '.$activity_subject.PHP_EOL.'</li>';
        } 
    }

    include 'inc/footer.php';