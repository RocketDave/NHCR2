<?php 

// This is just an example of reading server side data and sending it to the client.
// It reads a json formatted text file and outputs it.
$path =getcwd();
$filename = $path."/data/MyData3.json";

$string = file_get_contents($filename);
echo $string;

// Instead you can query your database and parse into JSON etc etc

?>