<?php
    //require the database connection
    require_once 'connection.php';

    if(isset($_POST["submit"])){
        
        //User is trying to register to website => create variables based on user information
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"]; 
        
        
        //Checking if the email the user has inserted is already taken inside the database
        $sql_email = "SELECT * FROM users WHERE email='$email'";
        $result_email = mysqli_query($conn, $sql_email);

        if(mysqli_num_rows($result_email) > 0){
            //if the email already exists...
            echo " Sorry, email already taken";

        } else {
            //If the email doesn't already exist...

            //Hash the password
            //$password_hashed = password_hash($password, PASSWORD_DEFAULT);

            //create user => we're inserting the user's infomation into the same table within PHPMyAdmin
            $sql = "INSERT INTO users (fullname, email, userPassword) VALUES ('$name', '$email', '$password')";
            
            //check if everything worked
            if(mysqli_query($conn, $sql)){

                //if successful forward them back to the index.html page
                header("location: ../index.html");
            } else {
                //if not state that something went wrong
                echo "ERROR: Data wasn't stored in table 'users'";
            }
    
            //connection closed
            mysqli_close($conn);
        }

    } else {
        echo "fail";
    }
?>