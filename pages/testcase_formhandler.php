<?php
  require('../db/config.php');
  session_start();
  if (!isset($_POST["add-test"])){
    header("Location: unavailable.php"); 
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/editor_styles.css">
    <script src="https://kit.fontawesome.com/533d2d342d.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>

<body>

    <nav>
        <ul class="nav__links">
            <h1 class="title">codeatrapton</h1>
            <img class="codeatrapton_logo" src="../assets/codeatrapton_logo.svg" alt="codeatrapton_logo">
            <li><a href="editor.php"> Editor Panel </a></li>
            <li class="link_with_symbol"><a href="#"> Challenges & Contests </a><img class="pp"
                    src="../assets/party_popper.svg" width="16px"> </li>
        </ul>
    </nav>
    <hr>



</body>

</html>

<?php

if (isset($_POST["add-test"])){
    $input = $_POST["input"];
    $output = $_POST["output"];
}

$qid = $_POST["hidden-qid"];


if (gettype($input) == "string"){
    $input_type = "input_str";
}
else if (gettype($input) == "integer"){
    $input_type = "input_int";
}

if (gettype($output) == "string"){
    $output_type = "output_str";
}

else if (gettype($output) == "integer"){
    $output_type = "output_int";
}


$query = "INSERT INTO question_test_case(
   question_id, $input_type, $output_type)
    VALUES ('$qid', '$input', '$output');";

$insertresult = pg_query($db_conn, $query);
$response = "Test case added successfully to question!";
if(!$insertresult){
    $response = "<h3 id=\"errorMsg\">Cannot add test case!</h3>";
}
echo $response;
?>