<?php
    require('base.php');

    $firstname='';
    $surname=''; 
    $email='';
     $phonenumber='';
     $password='';
    if(isset($_POST['signup'])){
           
            //picking up data from the form
            $firstname=$_POST['fname'];
            $surname=$_POST['surname'];
            $phonenumber=$_POST['phonenumber'];
            $email=$_POST['email'];
            $password=$_POST['password'];
        
            $error=array('fname'=>'', 'surname'=>'', 'phonenumber'=>'','email'=>'', 'password'=>'');
            //echo"<p style='color:white;'>$firstname $surname $email $phonenumber $password<p/>"; 
            //(testing if data has gone to server)

   //check if firstname has been filled
   if(empty($firstname)){
    $error['fname']="<p style='color:red;'>please enter your first name<p/>";
      }else{
             //prevent cross site scripting attack
            $firstname=htmlspecialchars($firstname);
      }
    if(empty($surname)){
     $error['surname']="<p style='color:red;'>please enter your surname<p/>";
          }else{
            $surname=htmlspecialchars($surname);
          }  
    if(empty($phonenumber)){
        $error['phonenumber']="<p style='color:red;'>please enter your phonenumber<p/>";
           }else{
            $phonenumber=htmlspecialchars($phonenumber);

              }
     if(empty($email)){
      $error['email']="<p style='color:red;'>please enter your email<p/>";
                  }else{
                    $email=htmlspecialchars($email);
                  }
   
   if(array_filter($error)){
       echo"<p style='color:red'>please sort the above errors before you proceed</p>";
    }else{
         //sql statement to insert data to the user table
            $sql="INSERT INTO customer(firstname,surname,email,password,phonenumber) 
             VALUES('$firstname','$surname','$email','$password','$phonenumber')";
            //execute sql statement using query() function and check if data is saved successfully
            mysqli_query($dbconnect,$sql);
                
            header("Location:login.php");
                    // if($dbconnect->query($sql)===TRUE) {
                    //       echo"New record created successfully" ;
                        
                    //  }else{
                    //       echo"Error:".$dbconnect->error;
                    //    }
        }
    }  
//close database connection
mysqli_close($dbconnect);
?>

?>
<!DOCTYPE html>
<html>

<head>
    <title>signup page</title>
    <style>
        @import "compass/css3";
        body {
            background: #384047;
            font-family: sans-serif;
            font-size: 10px
        }
        
        form {
            background: #fff;
            padding: 4em 4em 2em;
            max-width: 400px;
            margin: 50px auto 0;
            box-shadow: 0 0 1em #222;
            border-radius: 2px;
        }
        
        h2 {
            margin: 0 0 50px 0;
            padding: 10px;
            text-align: center;
            font-size: 30px;
            color: darken(#e5e5e5, 50%);
            border-bottom: solid 1px #e5e5e5;
        }
        
        p {
            margin: 0 0 3em 0;
            position: relative;
        }
        
        input {
            display: block;
            box-sizing: border-box;
            width: 100%;
            outline: none;
            margin: 0;
        }
        
        input[type="text"],
        input[type="password"] {
            background: #fff;
            border: 1px solid #dbdbdb;
            font-size: 1.6em;
            padding: .8em .5em;
            border-radius: 2px;
        }
        
        input[type="text"]:focus,
        input[type="password"]:focus {
            background: #fff
        }
        
        span {
            display: block;
            background: #F9A5A5;
            padding: 2px 5px;
            color: #666;
        }
        
        input[type="submit"] {
            background: button;
            box-shadow: 0 3px 0 0 darken(rgba(148, 186, 101, 0.7), 10%);
            border-radius: 2px;
            border: none;
            color: #68B25B;
            cursor: pointer;
            display: block;
            font-size: 2em;
            line-height: 1.6em;
            margin: 2em 0 0;
            outline: none;
            padding: .8em 0;
            text-shadow: 0 1px #68B25B;
        }
        
        input[type="submit"]:hover {
            background: rgba(148, 175, 101, 1);
            text-shadow: 0 1px 3px darken(rgba(148, 186, 101, 0.7), 30%);
        }
        
        label {
            position: absolute;
            left: 8px;
            top: 12px;
            color: #999;
            font-size: 16px;
            display: inline-block;
            padding: 4px 10px;
            font-weight: 400;
            background-color: rgba(255, 255, 255, 0);
        }
        
        .floatLabel {
            top: -11px;
            background-color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }
    </style>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="sign">
        <h2>Sign Up</h2>

        <p>
            <label for="firstname" class="floatLabel" >First name</label>
            <input type="text" id="fname" name="fname" >
            <?php if(isset($error['firstname'])){
                 echo $error['firstname'] ;
             }?>
        </p>
        <p>
            <label for="surname" class="floatLabel">Surname</label>
            <input type="text" id="surname" name="surname">
            <?php if(isset($error['surname'])){
             echo $error['surname'];
            }?>
        </p>
        <p>
            <label for="Email" class="floatLabel"></label>
            <input id="email" name="email" type="email" placeholder="Email">
            <?php if(isset($error['email'])){
             echo $error['email'];
            }?>
        </p>
        <p>
            <label for=" password " class="floatLabel "></label>
            <input id="password" name="password" type="password" placeholder=" Password " required>
            
        </p>
        <p>
            <label for="phonenumber " class="floatLabel "></label>
            <input id=" phonenumber " name="phonenumber" type="tel" placeholder="07xxxxxxxx ">
            <?php if(isset($error['phonenumber'])){
             echo $error['phonenumber'];
            }?>

        </p>
        <p>
            <input type="submit" value="Create my Account" id="signup" name="signup">
        </p>
    </form>


    <script type=" text/javascript ">
        <!-- const form = document.getElementById('sign');
        const fname = document.getElementById('fname');

        form.addEventListener('submit', (e) => {

                alert("you are here ");

            }) -->
    </script>

</body>

</html>