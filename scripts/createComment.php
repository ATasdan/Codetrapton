<?php
require('../db/config.php');

if (isset($_GET["question_id"]) && isset($_GET["user_id"])) {
    $specific_question_id = $_GET["question_id"];
    $user_id = $_GET["user_id"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/533d2d342d.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="./styles/indexStyle.css" />
    <title>Codetrapton</title>
    <style>
        .list {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .list label {
            display: block;
        }

        .list input {
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="list">
        <label for="">Comment</label>
        <input type="text" name="comment_body" id="comment_create">
    </div>
    <div class="list">
        <button type="button" class="btn" id="createComment">Send</button>
    </div>

    <script>
        $(document).ready(function() {
            $("#createComment").click(function() {
                var comment_body = document.getElementById('comment_create').value;
                var user_id = document.getElementById('user_id_comment').value;
                var question_id = document.getElementById('question_id_comment').value;
                $.ajax({
                    url: "api.php",
                    type: "POST",
                    data: {
                        'comment_body': comment_body,
                        'user_id': user_id,
                        'question_id': question_id
                    },
                    success: function(result) {
                        console.log(result);
                    }
                });
            });
        });
    </script>
</body>

</html>