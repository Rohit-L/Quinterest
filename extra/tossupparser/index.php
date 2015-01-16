<?php
 
ini_set('auto_detect_line_endings',true);
$text = file_get_contents("convert.txt");


function text_to_csv( $text = null ) {
    $lines  = explode( "\n", $text );
    $data   = null;
    foreach( $lines as $line ) {
        $line = trim( $line );
        
        if ( empty( $line ) ) {
            $data .= "\r\n";
        }


        if ( preg_match( '/^([0-9]+)\.(.+?)$/', $line, $quest ) ) {
            
            $id = "0";
            $tournament = "Ladue Spring Invitational Tournament III";
            $difficulty = "HS";
            $round = "LISTIII_Round01.docx";
            $year = "2012";
            
            
            
            $data .="|$id|,|$tournament|,|$round|,|$difficulty|,|$year|,";
            $data .= "|".trim( $quest[1] )."|,";
            $data .= "|".trim( $quest[2] )."|,";
        }
        if ( preg_match( '/^answer\:(.+?)$/i', $line, $quest ) ) {
            $data .= "|".trim( $quest[1] )."|,";
            
        }
    }
    return chop($data, ',');
}

$info = text_to_csv( $text );

$tochops = explode("\r\n", $info );

foreach( $tochops as $value) {
    $value = rtrim($value, ",");
    echo "$value\r\n";
}


?>