<?php
  require('../db/config.php');
  session_start();
  if (!isset($_POST["sol-submit"])){
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
    <div class="title_div">

        <?php 

        $query = "INSERT INTO question_test_case(
            question_id, input_str, output_str, input_int, output_int)
            VALUES (?, ?, ?, ?, ?, ?);";
            
        $solution = $_POST["q-solution"];
        $question_nature = "coding_question_view";

        if ( isset($_POST["programming_language"])){
          $programming_language = $_POST["programming_language"];
          $question_nature = "non_coding_question_view";
        }

        if (isset($_SESSION["q_id"])){
          $question_id = $_SESSION["q_id"];
          $query = "UPDATE question SET solution='$solution' WHERE question_id ='$question_id'";
        }

        else {
          die;
        }
         
        $addSolutionResult = pg_query($db_conn, $query);
        $response = "";
        if(!$addSolutionResult){
            $response = "<h3 id=\"errorMsg\">Cannot add problem!</h3>";
        }
        echo $response;
        
        ?>

        <i style="cursor: pointer; margin-left:50px;" onclick="history.back()" class="fa-solid fa-angle-left"></i>



        <h1 class="page_title">Add Test Case to

            <?php 

        echo ($_POST["hidden-qt"]);
      ?>
            Problem
        </h1>
    </div>
    <div class="main_content">

        <form action="testcase_formhandler.php" method="POST">

            <div>

                <br>
                <label for="input[0]">Input </label>
                <input type="text" name="input">
                <label for="output[0]">Output </label>
                <input type="text" name="output">
                <button type="submit" name="add-test">Add Test Case</button>
            </div>

            <input type="hidden" id="hidden-qid" value=<?php echo $_SESSION["q_id"]; ?> name="hidden-qid" !checked />

        </form>

    </div>







</body>

</html>