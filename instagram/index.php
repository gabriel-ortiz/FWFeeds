<?php
/**
 * 
 * Script to return formatted JSON from Instagram for FourWinds live data feed
 * 
 * @return Instagram feed object
 * 
 */

//helper functions and API keys
require('functions.php');
require('../api_constants.php');

//require Composer and Guzzle client
require_once('../vendor/autoload.php');
use GuzzleHttp\Client;

/*
ID's
CCL:        1451148979
Scripps:    353998619
HMC:        2140058007
Pomona:     575276754
CMC:        201125743
KGI:        2182583079
Pitzer:     1516094991
CGU:        310313134

*/


function printJSON($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

//check if variable is set
//check if variable is int
//check if variable is less than 15
if( isset( $_GET['instaID'] ) && is_numeric( $_GET['instaID'] )  ){
    //strip html tags
    $instaID = strip_tags( $_GET['instaID'] );
}else{
    //if something fishy is going on, always set variable to CCL instagram
    $instaID = 1451148979;
}

$ReadyForFW = array();

$client = new GuzzleHttp\Client();

try {
    $response = $client->request('GET', 'https://api.instagram.com/v1/users/'. $instaID .'/media/recent/?', [
                            'query' => [
                                    'access_token'  => INSTA_KEY,
                                    'count'         => '5',
                                ]
                        ]
    
                    );   
    
    $instaData = $response->getBody(TRUE);
    
    $posts = json_decode($instaData, true);
    
    //printJSON($posts);

    if($posts['meta']['code'] != '200' 
        || $posts === null 
        || json_last_error() !== 0){
        //execute error placeholder code
            $instaFW = array();
                $instaFW['img']             = "http://" . $_SERVER['SERVER_NAME'] . '/instagram/images/gear-icon.png';
                $instaFW['caption']         = "More Instagram photos coming soon";
                $instaFW['InstaStatus']     = $posts['meta']['code'];
                $instaFW['jsonError']       = json_last_error();
                $instaFW['dataLength']      = count($posts);
                $instaFW['jsonResponse']    = $posts;
                
            array_push($ReadyForFW, $instaFW);
    }else{
        
        //execute good JSON response
        foreach($posts['data'] as $post){
            $instaFW = array();
                $instaFW['profilePic']  = $post['user']['profile_picture'];
                $instaFW['img']         = $post['images']['standard_resolution']['url'];
                $instaFW['username']    = "@".$post['user']['username'];
                $instaFW['caption']     =  getExcerpt( stringCleaner($post['caption']['text']) ) ;
                
            array_push($ReadyForFW, $instaFW);
        }    
        
    }//end of if 
    
    //print JSON data
    header('Content-Type: application/json');
    echo json_encode( array( 'instagramPhotos' => $ReadyForFW  ) );    

    
} catch (RequestException $error) {
     echo $error->getResponse()->getStatusCode();
     echo $error->getResponse()->getBody(true);
     echo $error->getResponse()->getUrl();
}

?>