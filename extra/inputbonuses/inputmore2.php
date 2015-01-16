<?php session_start(); ?>
<html>
<head>
<title>Quinterest: Input Questions</title>
</head>
<body>
<?php
$i = $_SESSION['i'];

$intro = $_POST['intro'];
$question1 = $_POST['question1'];
$answer1 = $_POST['answer1'];
$question2 = $_POST['question2'];
$answer2 = $_POST['answer2'];
$question3 = $_POST['question3'];
$answer3 = $_POST['answer3'];
$category = $_POST['category'];
$subcategory = $_POST['subcategory'];

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
$intro = mb_convert_encoding($intro, 'UTF-8');
$question1 = mb_convert_encoding($question1, 'UTF-8');
$question2 = mb_convert_encoding($question2, 'UTF-8');
$question3 = mb_convert_encoding($question3, 'UTF-8');
$answer1 = mb_convert_encoding($answer1, 'UTF-8');
$answer2 = mb_convert_encoding($answer2, 'UTF-8');
$answer3 = mb_convert_encoding($answer3, 'UTF-8');
$intro = str_replace($chr, $rpl, $intro);
$question1 = str_replace($chr, $rpl, $question1);
$question2 = str_replace($chr, $rpl, $question2);
$question3 = str_replace($chr, $rpl, $question3);
$answer1 = str_replace($chr, $rpl, $answer1);
$answer2 = str_replace($chr, $rpl, $answer2);
$answer3 = str_replace($chr, $rpl, $answer3);

$_SESSION['intros'][$i] = $intro;
$_SESSION['questions1'][$i] = $question1;
$_SESSION['questions2'][$i] = $question2;
$_SESSION['questions3'][$i] = $question3;
$_SESSION['answers1'][$i] = $answer1;
$_SESSION['answers2'][$i] = $answer2;
$_SESSION['answers3'][$i] = $answer3;
$_SESSION['categories'][$i] = $_POST['category'];
$_SESSION['subcategories'][$i] = $_POST['subcategory'];
echo '<a href="./inputmore.php" style="color:black"><button type="button">More Bonuses?</button></a>';
echo '<a href="./input2.php" style="color:black"><button type="button">Done</button></a>';
?>
</body>
</html>