<?php
/**
 * 
 * Basic script that returns formatted JSON for FourWinds Live Data Feed
 * 
 * @return LYLevents object
 * 
 */

//helper functions and API keys
require('LYLfunctions.php');
require('../api_constants.php');

//require Composer and Guzzle client
require_once('../vendor/autoload.php');
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;

// $LYL_params = array(
//                     'iid'       => '333',
//                     'cal_id'    => '1889',
//                     'key'       => LIBCAL_KEY               
//                 );
//$response = $client->request('GET', 'https://api2.libcal.com/1.0/events/?'. http_build_query($LYL_params) );
//1889

$client = new GuzzleHttp\Client();

$ReadyForFW = array();

try {
    $response = $client->request('GET', 'https://api2.libcal.com/1.0/events/?', [
                            'query' => [
                                    'iid'       => '333',
                                    'cal_id'    => '1889',
                                    'key'       => LIBCAL_KEY                                
                                ]
                        ]
    
                    );   
    
    $events = $response->getBody(TRUE);
    $events = json_decode($events, true);

    foreach($events['events'] as $event){
        $LYL_FW = array();
            $LYL_FW['title']            = $event['title'];
            $LYL_FW['featured_img']     =  testImage( $event['featured_image'] );
            $LYL_FW['location']         = $event['location']['name'];
            $LYL_FW['start']            = fixDateTime( $event['start'] );
            $LYL_FW['end']              = fixDateTime( $event['end'] );
            $LYL_FW['weekday']          = getWeekDay( $event['start'] );
            $LYL_FW['Month_Day']        = getMonthDay( $event['start'] );
            $LYL_FW['month']            = getMonthOnly( $event['start'] );
            $LYL_FW['day']              = getDayOnly( $event['start'] );
            $LYL_FW['description']      = stringCleaner( $event['description'] );
        
        //add results to ready for FW array    
        array_push($ReadyForFW, $LYL_FW);
    }      
     
    header('Content-Type: application/json');
    echo json_encode( array( 'LYLevents' => $ReadyForFW  ) );
    
} catch (BadResponseException $error) {
    $LYL_FW = array(); 
    
        $LYL_FW['title']        = $error->getResponse()->getStatusCode();
        $LYL_FW['description']  =  $error->getResponse()->getBody()->getContents();
        $LYL_FW['featured_img'] =  testImage( $event['featured_image'] );        
    
    //add results to ready for FW array    
    array_push($ReadyForFW, $LYL_FW);
    
    header('Content-Type: application/json');
    echo json_encode( array( 'LYLevents' => $ReadyForFW  ) );    
}

