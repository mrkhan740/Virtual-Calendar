<?php
    
    $username = "";
    $email = "";
    $errors = array();
    // connect to the database 
    $db = mysqli_connect('localhost','root', '', 'registration');

    //if the register button is clicked
    if (isset($_POST['register'])) {
        $username = mysql_real_escape_string($db, $_POST['username']);
        $email = mysql_real_escape_string($db, $_POST['email']);
        $password_1 = mysql_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysql_real_escape_string($db, $_POST['password_2']);

        //ensure that fields are filled
        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($email)){
            array_push($errors, "Email is required");
        }
        if(empty($password_1)){
            array_push($errors, "Password is required");
        }
        if($password_1 != $password_2){
            array_push($errors, "Password didn't match");
        }
        // if no errors, save user to DB
        if (count($errors) == 0) {
            $password = md5($password_1); // encrypt password
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email',
            '$password')";
            mysqli_query($db, $sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are noe logged in";
        }
    }

    

?>