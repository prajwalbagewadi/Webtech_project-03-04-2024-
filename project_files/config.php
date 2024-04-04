<?php

    // database connection establishment
    $db=mysqli_connect("localhost","root","","Web_DB") or die("Cannot connect");
    if($db){
        echo "connection Successful"."<br>";
    }
?>