<?php
require('../db/config.php');

if (isset($_POST)) {
    $comment_body = $_POST["comment_body"];
    $user_id = $_POST["user_id"];
    $question_id = $_POST["question_id"];
    if ($comment_body != "" and $user_id != "" and $question_id != "") {
        $date = time();
        $query = "INSERT INTO comment(user_id,question_id, comment_body, date) VALUES('$user_id', '$question_id', '$comment_body','$date');";
        $createcomment_result = pg_query($db_conn, $query);
    } else {
        echo "Incorrect inputs for comment";
    }
}
