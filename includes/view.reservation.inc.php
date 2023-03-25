<?php
require("base.php");

if(isset($_SESSION['firstname'])){
    
    $user = $_SESSION['firstname'];
    
    $sql = "SELECT * FROM book where user_fk='0'";
    $result = $dbconnect->query($sql);
    if ($result->num_rows > 0) {
        
        
        echo
        '
            <table class="table table-hover table-responsive-sm text-center">
                <thead>
                    <tr>
                        <th scope="col">Full Name</th>
                        <th scope="col">Guests</th>
                        <th scope="col">Reservation Date</th>
                        <th scope="col">Time Zone</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Register Date</th>
                        <th scope="col">Comments</th>
                        <th class="table-danger" scope="col"></th>
                    </tr>
                </thead> ';
                while($row = $result->fetch_assoc()) {
                    echo"
                            <tbody>
                                <tr>
                                <form action='includes/delete.php' method='POST'>
                                <input name='reserv_id' type='hidden' value=".$row["book_id"].">
                                  <th scope='row'>".$row["firstname"]." ".$row["surname"]."</th>
                                  <td>".$row["num_guests"]."</td>
                                  <td>".$row["r_date"]."</td>
                                  <td>".$row["time_zone"]."</td>
                                  <td>".$row["phonenumber"]."</td>
                                  <td>".$row["reg_date"]."</td>
                                  <td><textarea readonly>".$row["comment"]."</textarea></td>
                                  <td class='table-danger'><button type='submit' name='delete-submit' class='btn btn-danger btn-sm'>Cancel</button></td>
                                      </form>
                                </tr>
                          </tbody>";
                        
                    }   
                    echo "</table>";


    }
    else {    echo "<p class='text-white text-center bg-danger'>Your reservation list is empty!<p>"; }
    }
    
    
    
    


mysqli_close($dbconnect);

?>

