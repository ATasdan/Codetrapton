<?php

    require('../db/config.php');

    // Register/authorization handling
    if (!empty($_POST["action"])) {
        $queryType = $_POST["action"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        if ($queryType == "register") {
            $fullname = $_POST["fullname"];
            $email = $_POST["email"];
            $country = $_POST["country"];
            $phone = $_POST["phone"];
            $birthday = $_POST["birthday"];
            $gender = $_POST["gender"];

            $query = "INSERT INTO users (type,username,password,email,country,fullname,phone,birthday,gender) VALUES ('developer','$username','$password','$email','$country','$fullname','$phone','$birthday','$gender');";
            $registerResult = pg_query($db_conn, $query);

            $response = "";
            if(!$registerResult){
                $response = "<h3 id=\"errorMsg\">This username is already registered!</h3>";
            }
        } elseif ($queryType == "devLogin") {
            $query = "SELECT username,fullname FROM users WHERE username = '$username' AND password='$password';";
            $devLoginResult = pg_query($db_conn, $query);

            $response = "";
            if (pg_num_rows($devLoginResult) == 0) {
                $response = "<h3 id=\"errorMsg\">Invalid username or password</h3>";
            } else {
                $response = "<h3>Success!</h3>";
            }
        } elseif ($queryType == "editorLogin") {
            $query = "SELECT username,fullname FROM users WHERE username = '$username' AND password='$password';";
            $editorLoginResult = pg_query($db_conn, $query);

            $response = "";
            if (pg_num_rows($editorLoginResult) == 0) {
                $response = "<h3 id=\"errorMsg\">Invalid username or password</h3>";
            } else {
                $response = "<h3>Success!</h3>";
            }
        } elseif ($queryType == "companyLogin") {
            $query = "SELECT username,fullname FROM users WHERE username = '$username' AND password='$password';";
            $companyLoginResult = pg_query($db_conn, $query);

            $response = "";
            if (pg_num_rows($companyLoginResult) == 0) {
                $response = "<h3 id=\"errorMsg\">Invalid username or password</h3>";
            } else {
                $response = "<h3>Success!</h3>";
            }
        }

        echo $response;
        die;
    }


    
