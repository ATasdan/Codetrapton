<?php
require('../db/config.php');

if (isset($_GET["question_id"]) && isset($_GET["user_id"])) {
  echo "burası";
  $specific_question_id = $_GET["question_id"];
  $user_id = $_GET["user_id"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <title>Document</title>

  <style>
    .wrapper>div {
      background: #eee;
      padding: 1em;
    }

    .wrapper {
      display: grid;
      grid-template-columns: 50% 50%;
      height: 100vh;
    }

    .wrapper>div:nth-child(even) {
      background: #B1D4E0;
    }

    .flex-container {
      border-radius: 25px;

      display: flex;
      justify-content: space-around;
      background-color: #B1D4E0;
    }

    .flex-container>div {
      background-color: #B1D4E0;
      margin: 1px;
      padding: 2px;
      font-size: 18px;
    }

    .title-container {
      border-radius: 25px;
      background-color: #B1D4E0;
    }

    .submit-solution-area {
      overflow-y: scroll;
      overflow-x: scroll;
      height: 200px;
      resize: both;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <div>
      <?php
      $query = "SELECT * FROM question WHERE question_id = '$specific_question_id';";
      $registerResult = pg_query($db_conn, $query);

      $query2 = "SELECT findBestTime($specific_question_id)";
      $registerResult2 = pg_query($db_conn, $query2);
      if (!$registerResult) {
        echo "An error occurred.\n";
        exit;
      }
      while ($row = pg_fetch_assoc($registerResult)) {
          $row2 = pg_fetch_assoc($registerResult2);
        echo "
            <div class = 'title-container'><h1>SOLVE PROBLEM:" . $row['question_title'] . " </h1></div>
            <div class = 'flex-container'>
            <div><h4>Difficulty: " . $row["difficulty"] . "</h4></div>
            <div><h4>BEST TIME: " . $row2['findbesttime'] . "</h4></div>
            <div><h4><i class='fa fa-clock-o' style='font-size:18px'></i> " . $row["time_limit"] . "min </h4></div>
            </div>
            <h1>PROMPT:" . $row['question_prompt'] . " </h1>

            <td>Time Spent: </td>
            <div ><p id='countdown'>" . $row["time_limit"] . "</p></div>";
      }
      $question = pg_fetch_row($registerResult)
      ?>
      <td>SUBMIT YOUR ANSWER BELOW: </td>
      <form action='' method='post' target='_blank'>
        <textarea id='solution-text' class='submit-solution-area'></textarea>
        <button type='button' onclick="attempted()">SUBMIT!</button>
      </form>
    </div>

    <div>
      <h3>Code Playground</h3>
      <iframe style='max-width:100%; border: none; height: 375px; width: 700px;' height=375 width=700 src=https://www.interviewbit.com/embed/snippet/2e370ee9d01366222eef title='Interviewbit Ide snippet/2e370ee9d01366222eef' loading="lazy" allow="clipboard-write" allowfullscreen referrerpolicy="unsafe-url" sandbox="allow-scripts allow-same-origin allow-popups allow-top-navigation-by-user-activation allow-popups-to-escape-sandbox"></iframe>
    </div>


    <script type="text/javascript">
      function attempted() {
        var solution = document.getElementById('solution-text').value;
        var time = document.getElementById('countdown').innerHTML;

        if (solution === "") {
          alert("SOLUTIN IS EMPTY")
          return false
        }
        $.ajax({
          url: '/scripts/attempAjax.php',
          type: 'POST',
          dataType: "JSON",
          data: {
            solution: solution,
            user_id: <?php echo "$user_id"; ?>,
            specific_question_id: <?php echo "$specific_question_id"; ?>,
            time: time
          },
          success: function(response) {
            console.log(response);
            if (response == "TRUE") {
              alert("TRUE ANSWER! YOUR TIME: " + time);
            } else {
              alert("FALSE ANSWER! YOUR TIME: " + time);
            }
          }
        })
        return false;
      }
    </script>
    <!-- This script tag contains the 
        javascript code in the written URL -->
    <script src="../scripts/countdown.js"></script>

  </div>

</body>

</html>