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
        <label for="">User id</label>
        <input type="text" name="user_id" id="user_id_comment">
    </div>
    <div class="list">
        <label for="">Question id</label>
        <input type="text" name="question_id" id="question_id_comment">
    </div>
    <div class="list">
        <button type="button" class="btn" id="createComment">Send</button>
    </div>
    <div class="createSponsor">
        <i id="arrow" onclick="goBackDown()" class="fa-solid fa-arrow-up"></i>
        <div class="prompt">
            <h1 class="textField">Create Interview</h1>
            <img class="monkey" src="./assets/monkey.jps" alt="" srcset="" />
        </div>
        <form class="forms" action="index.php" method="post" target="refresh">
            <input type="hidden" name="action" value="register">
            <div class="fieldContainer">
                <h1>Sponsor</h1>
                <input type="text" name="sponsor" id="regname" required />
            </div>
        </form>
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