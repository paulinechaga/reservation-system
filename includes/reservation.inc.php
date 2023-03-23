<?php
require("../base.php");

//between function.. elenxei an oi xaraktires einai mesa sta oria p thetoume
function between($val, $x, $y){
    $val_len = strlen($val);
    return ($val_len >= $x && $val_len <= $y)?TRUE:FALSE;
}
    $fname= '';
    $lname= '';
    $date= '';
    $time= '';
    $guests= '';
    $tele = '';
    $comments = '';

if(isset($_POST['reserv-submit'])) {

    $fname= $_POST['fname'];
    $lname= $_POST['surname'];
    $date= $_POST['date'];
    $time= $_POST['time'];
    $guests= $_POST['num_guests'];
    $tele = $_POST['phonenumber'];
    $comments = $_POST['comments'];
    
    if($guests==1 || $guests==2){
        $tables=1;
    }
    else{
    $tables=ceil(($guests-2)/2);
    }
    
    
    if(empty($fname) || empty($lname) || empty($date) || empty($time) || empty($guests) || empty($tele)) {
        echo '<h5 class="bg-danger text-center">Fill all fields, Please try again!</h5>';
        exit();
    }
        else if(!preg_match("/^[a-zA-Z ]*$/", $fname) || !between($fname,2,20)) {
            echo '<h5 class="bg-danger text-center">Invalid First Name, Please try again!</h5>';
        exit();
    }
        else if(!preg_match("/^[a-zA-Z ]*$/", $lname) || !between($lname,2,40)) {
            echo '<h5 class="bg-danger text-center">Invalid Last Name, Please try again!</h5>';
        exit();
    }
        else if(!preg_match("/^[0-9]*$/", $guests) || !between($guests,1,3)) {
            echo '<h5 class="bg-danger text-center">Invalid Guests, Pleast try again!</h5>';
        exit();
    }
        else if(!preg_match("/^[a-zA-Z0-9]*$/", $tele) || !between($tele,6,20)) {
            echo '<h5 class="bg-danger text-center">Invalid Telephone, Pleast try again!</h5>';
        exit();
    }    
        else if(!preg_match("/^[a-zA-Z 0-9]*$/", $comments) || !between($comments,0,200)) {
            echo '<h5 class="bg-danger text-center">Invalid Comment, Pleast try again!</h5>';
        exit();
    }
    
    else{
     
    $sql = "SELECT t_tables FROM tables WHERE t_date='$date'";
    $result=mysqli_query($dbconnect,$sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $a_tables=$row["t_tables"];
    }
    }
    else{$a_tables=20;} 
    
    $sql = "SELECT SUM(num_tables) FROM book WHERE r_date='$date' AND time_zone='$time'";
    $result=mysqli_query($dbconnect,$sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $current_tables=$row["SUM(num_tables)"];
    }
    }
    if($current_tables + $tables > $a_tables){
        echo '<h5 class="bg-danger text-center">Reservations are full this date and timezone, Please try again!</h5>';
    }
          
           
    
    else {
    
         $sql = "INSERT INTO book(firstname,surname, num_guests, num_tables, r_date, time_zone,phonenumber, comment) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt =mysqli_prepare($dbconnect, $sql);   
            mysqli_stmt_bind_param($stmt, "ssssssss", $fname, $lname, $guests,$tables, $date, $time, $tele, $comments);
            mysqli_stmt_execute($stmt);
              header("Location: ../reservation.php?reservation=success");
                    exit();
                }
        
            } 
       

   mysqli_stmt_close($stmt);
   mysqli_close($dbconnect);
}
?>