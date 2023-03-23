<?php
    //connect to the database
   $dbconnect= mysqli_connect('localhost','admin','vote@2022','reservation');
   // check whether database connection is successful
       if(!$dbconnect){
           echo "databaSe failed to connect" .mysqli_connect_error();
    } else{
         echo "<p style='color:white'>Database connected</p>";
    }
?>