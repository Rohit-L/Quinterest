<?php
 
ini_set('auto_detect_line_endings',true);
$text = file_get_contents("convert.txt");


function text_to_csv( $text = null ) {
    $filename = "test.txt";
    $lines  = explode( "\n", $text );
    $data   = null;
    foreach( $lines as $line ) {
        $line = trim( $line );
        
        if ( empty( $line ) ) {
            $data .= "|RL|";
            $data .= "\r\n";
        }
        if ( preg_match( '/^category\:(.+?)$/i' , $line, $quest ) ) {
            $data .="|".trim( $quest[1] )."|,";
        }
        if ( preg_match( '/^\[10\](.+?)$/', $line, $quest ) ) {
            $data .=  "|".trim( $quest[0] )."|,";
        }

        if ( preg_match( '/^([0-9]+)\.(.+?)$/', $line, $quest ) ) {
            
            $id = "0";
            $tournament = "2013 Prison Bowl";
            $difficulty = "HS";
            $round = "Round15.docx";
            
            
            
            $data .="|$id|,|$tournament|,|$round|,|$difficulty|,";
            $data .= "|".trim( $quest[1] )."|,";
            $data .= "|".trim( $quest[2] )."|,";
        }

        if ( preg_match( '/^answer\:(.+?)$/i', $line, $quest ) ) {
            $data .= "|".trim( $quest[0] )."|,";
            
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