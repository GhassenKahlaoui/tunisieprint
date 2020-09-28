
<?php
$homepage = file_get_contents('https://www.tinkco.com/');
echo str_replace("/fr/compte/login.asp","login.php",$homepage);
//echo $homepage;
?>
