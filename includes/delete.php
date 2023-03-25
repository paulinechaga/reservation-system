<?php


//delete reservation

if(isset($_POST['delete-submit'])) {
 
 require ("../base.php");
 
 $reservation_id = $_POST['reserv_id'];
    
 $sql = "DELETE FROM book WHERE book_id =$reservation_id";
if (mysqli_query($dbconnect, $sql)) {
    header("Location: ../view_reservations.php?delete=success");
} else {
    header("Location: ../view_reservations.php?delete=error");
}
}



//delete tables


if(isset($_POST['delete-table'])) {
 
 //require 'base.php';
 
 $tables_id = $_POST['tables_id'];
    
 $sql = "DELETE FROM tables WHERE tables_id =$tables_id";
if (mysqli_query($conn, $sql)) {
    header("Location: ../view_tables.php?delete=success");
} else {
    header("Location: ../view_tables.php?delete=error");
}
}


mysqli_close($dbconnect);
?>

    


