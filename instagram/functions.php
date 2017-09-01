<?php

$caption = "A French world map from our collection \"Maps and Mapping at the Claremont Colleges.\" Check out the rest of the maps on our digital libraries website, where we now have 150 of them scanned in and digitized! .\n..\n...\n#map #mapmonday #library #books #maps #librarians #reading #globalart #art #beautiful #picoftheday #specialcollections #honnoldlibrary #claremontcolleges #claremontcollegeslibrary #rare #ccl_speccoll";

$caption2 = "<p style=\"color:red;\">If a skeleton is a little too #basic how about this picture of blood vessels for your #pagefrights from RECUEIL DE PLANCHES SUR LES SCIENCES ET LES ARTS. At least I hope that's just a picture of blood vessels and not an atomically image of a swamp creature here to destroy us all....\n#claremontcolleges #ccl_speccoll #claremontcollegeslibrary #specialcollections</p>";



//$caption = trim($caption, '\n');

//$caption2 = strip_tags($caption2);

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
        $caption = strip_tags($caption);
        $caption = trim($caption);
        $caption = str_replace(array("\r\n", "\n\r", "\r", "\n", "/[\n\<]/" ), " ", $caption);
        return $caption;
}

//echo cleanHash($caption);

//echo cleanHash($caption2);


function getExcerpt($str, $startPos=0, $maxLength=120) {
	if(strlen($str) > $maxLength) {
		$excerpt   = substr($str, $startPos, $maxLength-3);
		$lastSpace = strrpos($excerpt, ' ');
		$excerpt   = substr($excerpt, 0, $lastSpace);
		$excerpt  .= '...';
	} else {
		$excerpt = $str;
	}
	
	return $excerpt;
}


?>