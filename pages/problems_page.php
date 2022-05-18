
<?php
    require('../db/config.php');
    if (isset($_GET["user_id"])) {
        $user_id = $_GET["user_id"];
    }
    ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Problems</title>
    <script src="../scripts/filter.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <form action="" id="questionType" name="questionType">
        Find Problems :
        <input type="radio" id = "radio0" name ="question_type" value="question" checked>
        All Questions
        <input type="radio" id = "radio1" name ="question_type" value="coding_question">
        Coding question
        <input type="radio" id = "radio2" name ="question_type" value="non_coding_question">
        Non coding question

    </form>
<div class = "container">
<table class="table table-bordered" id="question-table">
    <thead>

        <th col-index = 1>Title
        <select class="table-filter" id="" onchange="filter_rows()">
                <option value="all"></option>
            </select>
        </th>

        <th col-index = 2>Ranking
        <select class="table-filter" id="" onchange="filter_rows()">
                <option value="all"></option>
            </select>
        </th>
        <th col-index = 3>Attemps
        <select class="table-filter" id="" onchange="filter_rows()">
                <option value="all"></option>
            </select>
        </th>
        <th col-index = 4>Difficulty
            <select class="table-filter" id="" onchange="filter_rows()">
                <option value="all"></option>
            </select>
        </th>
        <th col-index = 5>Type
        <select class="table-filter" id="" onchange="filter_rows()">
                <option value="all"></option>
            </select>
        </th>
        <th col-index = 6>PREMIUM
        <select class="table-filter" id="" onchange="filter_rows()">
                <option value="all"></option>
            </select>
        </th>

        <th>&hearts;</th>
    </thead>
    <tbody>
    <?php
        $query = "SELECT * FROM question;";
        $registerResult = pg_query($db_conn, $query);
        if (!$registerResult) {
            echo "An error occurred.\n";
            exit;
        }
          while ($row = pg_fetch_assoc($registerResult)) {
              echo "<tr>
              <td>". $row['question_title'] ."</td>
              <td> DEFAULT </td>
              <td> 0</td>
              <td>". $row["difficulty"] ." </td>
              <td>". $row["question_type"] ." </td>
              <td>". $row["is_premium"] ." </td>

              <td>
                    <a class = 'btn btn-primary btn-sm' href = './specific_problem_page.php?question_id=".$row['question_id']."&user_id=$user_id'> SOLVE</a>
                    <a class = 'btn btn-primary btn-sm' href = 'like'> Like</a>
                    <a class = 'btn btn-danger btn-sm' href = 'dislike'> Dislike</a>    
               </td>
          </tr>";
          }
           
    ?>
    </tbody>
</table>
</div>
          <script>
              getUniqueValuesFromColumn()
          </script>


          <script type="text/javascript">
              /*$('input:radio[name="question_type"]').change(function () {   
                alert('hi');
        });*/
        document.querySelector("#radio0").addEventListener("change", function() {
                var value = "question";
        //alert("checked radio 1");
        $.ajax({
            url: "../scripts/problemsAjax.php",
            type: "POST",
            data: {request: value},
            beforeSend:function(){
                $(".container").html("<span>Working...</span>");
            },
            success:function(data){
                //alert('Successfully called');
                $(".container").html(data);
            },
         error: function(jqxhr, status, exception) {
             alert('Exception:', exception);
         }
        })
    });
              
            document.querySelector("#radio1").addEventListener("change", function() {
                var value = "coding_question";
        //alert("checked radio 1");
        $.ajax({
            url: "../scripts/problemsAjax.php",
            type: "POST",
            data: {request: value},
            beforeSend:function(){
                $(".container").html("<span>Working...</span>");
            },
            success:function(data){
                //alert('Successfully called');
                $(".container").html(data);
            },
         error: function(jqxhr, status, exception) {
             alert('Exception:', exception);
         }
        })
    });
            document.querySelector("#radio2").addEventListener("change", function() {
                var value = "non_coding_question";
                //alert("checked radio 2");
        $.ajax({
            url: "../scripts/problemsAjax.php",
            type: 'POST',
            data: {request: value},
            beforeSend:function(){
                $(".container").html("<span>Working...</span>");
            },
            success:function(data){
                //alert('Successfully called');
                $(".container").html(data);
            },
         error: function(jqxhr, status, exception) {
             alert('Exception:', exception);
         }
        })
    });
    </script>
</body>
</html>