<?php
require_once '../lib/core.php';
echo "This page was constructed to test the hookr and cleanr functions.";
echo "<br>";

hookr("This is a test of {hookr} and its {hooks}. One more {test}.");

echo "<br>";

$stringg = "If this {string} does not return any {matches} then it has passed {cleanr} successfully.";
$newstring = cleanr($stringg);
hookr($newstring);
echo $newstring;
echo "<br>";
echo "<br>";

$html = "<div style='border-style:solid;margin:5px;'>This is one div element!</div> <div style='border-style:dashed;margin:5px;'>This is another div element!</div>";
echo $html;
echo "<br>";
$nhtml = cleanr($html);
echo $nhtml;
?>
