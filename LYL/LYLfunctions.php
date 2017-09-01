<?php

function printJSON($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


$caption = "A French world map from our collection \"Maps and Mapping at the Claremont Colleges.\" Check out the rest of the maps on our digital libraries website, where we now have 150 of them scanned in and digitized! .\n..\n...\n#map #mapmonday #library #books #maps #librarians #reading #globalart #art #beautiful #picoftheday #specialcollections #honnoldlibrary #claremontcolleges #claremontcollegeslibrary #rare #ccl_speccoll";

$caption2 = "<p style=\"color:red;\">If a skeleton is a little too #basic how about this picture of blood vessels for your #pagefrights from RECUEIL DE PLANCHES SUR LES SCIENCES ET LES ARTS. At least I hope that's just a picture of blood vessels and not an atomically image of a swamp creature here to destroy us all....\n#claremontcolleges #ccl_speccoll #claremontcollegeslibrary #specialcollections</p>";

//$caption2 = preg_replace("/[\n\<]/"," ",$caption2);  
//$caption = str_replace(array("\r\n", "\n\r", "\r", "\n", "/[\n\<]/" ), " ", $caption);


function cleanHash($caption){
    //adds a special color to hashtags
    
    //strip tags
    $caption2 = strip_tags($caption2);
    
    //remove newlines
    $caption = str_replace(array("\r\n", "\n\r", "\r", "\n", "/[\n\<]/" ), " ", $caption);
    
    //turn string into array
    $wordArray = explode(' ', $caption);
    
    $processedArray = array();
    
    foreach($wordArray as $key => $value){
        if($value[0] == "#"){
            $processedArray[$key] = "<span style='color:#bdc0c7;'>". $value ."</span>";
            
        }else{
            $processedArray[$key] =  $value ;

        }//end of if
        

    }//end of foreach
    return $processedArray = implode(' ', $processedArray);

    
}//end of cleanHash()

function stringCleaner($caption){

        $caption = preg_replace('/(\'|&#0*39;)/', "'", $caption);    
        $caption = preg_replace('/(\'|&nbsp;)/', " ", $caption);         
        $caption = htmlspecialchars_decode($caption);
        $caption = strip_tags($caption);
        //$caption = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($caption))))));
        $caption = str_replace(array("\r\n", "\n\r", "\r", "\n", "/[\n\<]/" ), " ", $caption);

        return $caption;
}



// Date- time converting string
function fixDateTime($dateString){
    $date = new DateTime($dateString);
    return $date->format('g:i a') ;
}

//get Month only
function getMonthOnly($dateString){
    $date = new DateTime($dateString);
    return strtoupper( $date->format('M') );    
}

//get day only
function getDayOnly($dateString){
    $date = new DateTime($dateString); 
    return $date->format('d');
}

//Get Week Day
function getWeekDay($dateString){
    $date = new DateTime($dateString);
    return strtoupper( $date->format('D') );
}


//Get Month/Day
function getMonthDay($dateString){
    $date = new DateTime($dateString);
    return $date->format('m/d');
}

//test for slash at beginning of string, if so, then remove it
function removeSlash($url){
    $testUrl = substr($url, 0, 2);
    
    if( $testUrl == "//"){
        return substr($url, 2);
    }else{
        return $url;
    }
}

//test for featured image. If not there, insert default image
function testImage($featuredImg){
    if( $featuredImg != "" ){
        return "http:" . $featuredImg;
    }else{
        return "http://" . $_SERVER['SERVER_NAME'] . '/FWFeeds/LYL/images/Mudd1.jpg';
    }
}


?>