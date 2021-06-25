<?php

header("Content-type: text/html; charset=utf-8");
//$connection = mysqli_connect('sql5.freemysqlhosting.net', 'sql5421214', 'GME43ciZIl', 'sql5421214');
$connection = mysqli_connect('localhost', 'root', '', 'imovie');
mysqli_set_charset($connection, 'UTF8');

//check connect
// if($connection){
//     echo "yes connected!";
// }
