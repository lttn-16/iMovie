<?php 

    function confirm($result){
        global $connection;
        if(!$result){
            die(mysqli_error($connection));
        } 
    }

?>