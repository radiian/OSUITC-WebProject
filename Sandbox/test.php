<?php
require_once '../LIB/core.php';
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

echo "For example if the above test matched, it would look like this: <br>";
hookr($stringg);
?>
