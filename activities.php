<?php
    include 'inc/header.php';
     
    // Pipedrive API token
    $api_token = '68926f84300763d38ff5ea52f9f12b0039814782';

    // Pipedrive company domain
    $company_domain = 'allaboutpc-124cff';
     
    //URL for Activities listing with $company_domain and $api_token variables
    $url = 'https://'.$company_domain.'.pipedrive.com/v1/activities?api_token='.$api_token;
     
    //GET request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     
    // echo 'Sending request...'.PHP_EOL;
    echo '<h4>List of activities: '.PHP_EOL.'</h4>';
     
    $output = curl_exec($ch);
    curl_close($ch);
     
    // Create an array from the data that is sent back from the API
    // As the original content from server is in JSON format, convert it to a PHP array
    $result = json_decode($output, true);

    // Check if data returned in the result is not empty
    if (empty($result['data'])) {
        exit('No activities created yet'.PHP_EOL);
    }

    // Iterate over all found activities
    foreach ($result['data'] as $key => $activity) {
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