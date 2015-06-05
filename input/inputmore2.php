<?php session_start(); ?>
<html>
<head>
<title>Quinterest: Input Questions</title>
</head>
<body>
<?php
$i = $_SESSION['i'];
$tossup = $_POST['tossup'];
$answer = $_POST['answer'];

$chrmap = array(
   // Windows codepage 1252
   "\xC2\x82" => "'", // U+0082⇒U+201A single low-9 quotation mark
   "\xC2\x84" => '"', // U+0084⇒U+201E double low-9 quotation mark
   "\xC2\x8B" => "'", // U+008B⇒U+2039 single left-pointing angle quotation mark
   "\xC2\x91" => "'", // U+0091⇒U+2018 left single quotation mark
   "\xC2\x92" => "'", // U+0092⇒U+2019 right single quotation mark
   "\xC2\x93" => '"', // U+0093⇒U+201C left double quotation mark
   "\xC2\x94" => '"', // U+0094⇒U+201D right double quotation mark
   "\xC2\x9B" => "'", // U+009B⇒U+203A single right-pointing angle quotation mark

   // Regular Unicode     // U+0022 quotation mark (")
                          // U+0027 apostrophe     (')
   "\xC2\xAB"     => '"', // U+00AB left-pointing double angle quotation mark
   "\xC2\xBB"     => '"', // U+00BB right-pointing double angle quotation mark
   "\xE2\x80\x98" => "'", // U+2018 left single quotation mark
   "\xE2\x80\x99" => "'", // U+2019 right single quotation mark
   "\xE2\x80\x9A" => "'", // U+201A single low-9 quotation mark
   "\xE2\x80\x9B" => "'", // U+201B single high-reversed-9 quotation mark
   "\xE2\x80\x9C" => '"', // U+201C left double quotation mark
   "\xE2\x80\x9D" => '"', // U+201D right double quotation mark
   "\xE2\x80\x9E" => '"', // U+201E double low-9 quotation mark
   "\xE2\x80\x9F" => '"', // U+201F double high-reversed-9 quotation mark
   "\xE2\x80\xB9" => "'", // U+2039 single left-pointing angle quotation mark
   "\xE2\x80\xBA" => "'", // U+203A single right-pointing angle quotation mark
);
$chr = array_keys  ($chrmap);
$rpl = array_values($chrmap); 
$tossup = mb_convert_encoding($tossup, 'UTF-8');
$answer = mb_convert_encoding($answer, 'UTF-8');
$tossup = str_replace($chr, $rpl, $tossup);
$answer = str_replace($chr, $rpl, $answer);

$_SESSION['tossups'][$i] = $tossup;
$_SESSION['answers'][$i] = $answer;
$_SESSION['categories'][$i] = $_POST['category'];
$_SESSION['subcategories'][$i] = $_POST['subcategory'];
echo '<a href="./inputmore.php" style="color:black"><button type="button">More Tossups?</button></a>';
echo '<a href="./input2.php" style="color:black"><button type="button">Done</button></a>';
?>
</body>
</html>