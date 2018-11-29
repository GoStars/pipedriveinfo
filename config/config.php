<?php
    // Pipedrive API token
    $api_token = '68926f84300763d38ff5ea52f9f12b0039814782';

    // Pipedrive company domain
    $company_domain = 'allaboutpc-124cff';
     
    // URLs for Organizations, Persons, Deals, Activities and Notes listing, 
    // with $company_domain and $api_token variables
    $url_activ = 'https://'.$company_domain.'.pipedrive.com/v1/activities?api_token='.$api_token;
    $url_org = 'https://'.$company_domain.'.pipedrive.com/v1/organizations?api_token='.$api_token;
    $url_persons = 'https://'.$company_domain.'.pipedrive.com/v1/persons?api_token='.$api_token;
    $url_deals = 'https://'.$company_domain.'.pipedrive.com/v1/deals?api_token='.$api_token;
    $url_notes = 'https://'.$company_domain.'.pipedrive.com/v1/notes?api_token='.$api_token;
     
    //GET requests
    $ch_org = curl_init();
    curl_setopt($ch_org, CURLOPT_URL, $url_org);
    curl_setopt($ch_org, CURLOPT_RETURNTRANSFER, true);

    $ch_persons = curl_init();
    curl_setopt($ch_persons, CURLOPT_URL, $url_persons);
    curl_setopt($ch_persons, CURLOPT_RETURNTRANSFER, true);

    $ch_deals = curl_init();
    curl_setopt($ch_deals, CURLOPT_URL, $url_deals);
    curl_setopt($ch_deals, CURLOPT_RETURNTRANSFER, true);

    $ch_activ = curl_init();
    curl_setopt($ch_activ, CURLOPT_URL, $url_activ);
    curl_setopt($ch_activ, CURLOPT_RETURNTRANSFER, true);

    $ch_notes = curl_init();
    curl_setopt($ch_notes, CURLOPT_URL, $url_notes);
    curl_setopt($ch_notes, CURLOPT_RETURNTRANSFER, true);
    