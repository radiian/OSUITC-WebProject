<?php
require_once '../lib/hookr.php';

$myHookR = new HookR();

echo "This is a test of the HookR system<br>";
$string = "This is a string with a simple hook in it. It should display phpinfo(). It will also display the time. <br> {%sysinfo->infophp} <br> {%sysinfo->time} <br> {%sysinfo->test}";
echo $myHookR->parse($string, "");

?>
