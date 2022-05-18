<?php
  require('../db/config.php');
  session_start();
  if (!isset($_POST["q-submit"])){
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
        if (isset($_POST["q-submit"])){
        $question_nature = $_POST["q-t"];
        $question_title = $_POST["q-title"];
        $difficulty = $_POST["difficulty"];
        $question_type = $_POST["category"];
        $question_prompt = $_POST["q-prompt"];
        $question_body = $_POST["q-content"];

        if (isset($_POST["time-limit"])){
          $time_limit = (int) $_POST["tl-quantity"];
        }

        else {
          $time_limit = -1;
        }

        if ( isset($_POST["is-premium"])){
          $is_premium = true;
        }

        else {
          $is_premium = 'false';
        }

        if (isset($_POST["is-multi"])){
          $is_multi_choice = true;
        }

        else {
          $is_multi_choice = 'false';
        }

        if ( strcasecmp($question_nature,"coding" ) == 0){
          $query = "INSERT INTO coding_question_view (question_title, difficulty, question_type, question_prompt, question_body, solution, time_limit, is_premium, question_nature)
        VALUES ( '$question_title', '$difficulty', '$question_type', '$question_prompt', '$question_body', '', $time_limit, '$is_premium', 'coding_question') RETURNING question_id";
        }

        else {
          $query = "INSERT INTO non_coding_question_view (question_title, difficulty, question_type, question_prompt, question_body, solution, time_limit, is_premium, is_multi, question_nature)
            VALUES ('$question_title', '$difficulty', '$question_type', '$question_prompt', '$question_body', '', $time_limit,  '$is_premium','$is_multi_choice', 'non_coding_question') RETURNING question_id";
        }

        $addProblemResult = pg_query($db_conn, $query);

        $response = "";
            if(!$addProblemResult){
                $response = "<h3 id=\"errorMsg\">Cannot add problem!</h3>";
        }

        echo $response;

        $row = pg_fetch_row( $addProblemResult);
        $_SESSION["q_id"]= $row[0]; //POST QID ...
        

      }
      else {
        echo "<h3 id=\"errorMsg\">Cannot add problem!</h3>";
      }
        
        ?>

        <i style="cursor: pointer; margin-left:50px;" onclick="history.back()" class="fa-solid fa-angle-left"></i>



        <h1 class="page_title">Add Solution to
            <?php 
        //if (htmlspecialchars($_POST["q-t[0]"])) echo "<h1 class='page_title'>Coding Problem (optional) </h1>" 
        //$id = implode(",", $_POST['q-t']);

        echo ($_POST['q-t']);
      ?>
            Problem
        </h1>
    </div>
    <div class="main_content">

        <form action="add_solution.php" method="POST" onsubmit="addSolutionToProblem();">

            <ul class="q-selects">

                <?php if ( strcasecmp($_POST["q-t"],"coding")  == 0) {

                    echo '<li>
                    <label for="programming_language">Programming Language</label>
                    <select id="programming_language" name="programming_language">
                        <option value="Java">Easy</option>
                        <option value="C">Medium</option>
                        <option value="C++">Hard</option>
                    </select>
                </li>';

                } 
                ?>

                <input type="hidden" id="hidden-qt" value=<?php echo $_POST["q-t"]; ?> name="hidden-qt" !checked />





            </ul>


            <div>
                <label style="margin: 20px" for="q-content">Solution</label>

                <textarea class="textfield" type="text" id="q-solution" name="q-solution"
                    placeholder="Type here.."> </textarea>
            </div>

            <input name="sol-submit" class="submit_btn" type="submit" value="Submit">

        </form>

        <button value="Skip" id="btn-skip" onClick="document.location.href='add_solution.php'"> Skip this
            step </button>

    </div>


</body>

</html>