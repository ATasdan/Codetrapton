<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/533d2d342d.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/adminStyle.css" />
    <title>Codeatrapton</title>
</head>

<body>
    <h1>codeatrapton admin page</h1>
    <div class="forms">
        <form action="admin.php" method="post">
            <h2>Register an Editor</h2>
            <hr style="width:100%">
            <div class="fieldContainer">
                <h1>Editor Name</h1>
                <input type="text" name="editorName" id="editorName" required />
            </div>
            <div class="fieldContainer">
                <h1>Editor Email</h1>
                <input type="email" name="editorEmail" id="editorEmail" required />
            </div>
            <div class="fieldContainer">
                <h1>Editor Password</h1>
                <input type="password" name="editorPassword" id="editorPassword" required />
            </div>
            <button type="submit" id="editorReg" class="btn">register</button>
        </form>

        <form action="admin.php" method="post">
            <h2>Register a Company</h2>
            <hr style="width:100%">
            <div class="fieldContainer">
                <h1>Company Name</h1>
                <input type="text" name="companyName" id="companyName" required />
            </div>
            <div class="fieldContainer">
                <h1>Company Email</h1>
                <input type="email" name="companyEmail" id="companyEmail" required />
            </div>
            <div class="fieldContainer">
                <h1>Company Password</h1>
                <input type="password" name="companyPassword" id="companyPassword" required />
            </div>
            <button type="submit" id="companyReg" class="btn">register</button>
        </form>
    </div>

    <?php
        require('../db/config.php');

        if (isset($_POST["editorName"]) && isset($_POST["companyName"])) {
            echo "<h2 id=\"errorMsg\">Do not enter fill both forms!</h2>";
            die;
        }

        if (isset($_POST["editorName"])) {
            $name = $_POST["editorName"];
            $email = $_POST["editorEmail"];
            $password = $_POST["editorPassword"];
            $type = "editor";

        } elseif (isset($_POST["companyName"])) {
            $name = $_POST["companyName"];
            $email = $_POST["companyEmail"];
            $password = $_POST["companyPassword"];
            $type = "company";
        }
        else{
            die;
        }

        $query = "INSERT INTO users(type,username,email,password) VALUES ('$type','$name','$email','$password');";

        $result = pg_query($db_conn, $query);

        if ($type == "editor") {
            echo "<h2>Editor successfully registered!</h2>";
            die;
        }

        echo "<h2>Company successfully registered<h2>";
    ?>
</body>