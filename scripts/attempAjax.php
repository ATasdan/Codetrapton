<?php
    require('../db/config.php');
    if (!empty($_POST['solution'])) {
        $solution = $_POST['solution'];
        $specific_question_id = $_POST['specific_question_id'];
        $user_id =  $_POST['user_id'];
        $time = $_POST['time'];

        $trimmedString = preg_replace('/\s+/', '', $solution);
        $query = "SELECT handle_attempt($user_id, $specific_question_id, '$trimmedString', '$time')";
        $result = pg_query($db_conn, $query);
        $row = pg_fetch_assoc($result);
        $newAttemptId = $row['handle_attempt']; 

        //echo "result = $result";
    }

    $query = "SELECT solution FROM question WHERE question_id = $specific_question_id";
    $result = pg_query($db_conn, $query);
    $row = pg_fetch_assoc($result);
    $trimmedSolution = preg_replace('/\s+/', '', "".$row['solution']."");

    if(strcasecmp(trim($trimmedSolution), $trimmedString ) == 0){
        echo json_encode("TRUE");
        $query = "UPDATE user_question_attempt SET iscorrect = TRUE WHERE user_id = $user_id AND attempt_id = $newAttemptId AND question_id = $specific_question_id";
        $result = pg_query($db_conn, $query);

        $query = "SELECT updateAttemptCount($specific_question_id)";
        $result = pg_query($db_conn, $query);

        
        die();
    }else{
        echo json_encode("FALSE");
        $query = "UPDATE user_question_attempt SET iscorrect = FALSE WHERE user_id = $user_id AND attempt_id = $newAttemptId AND question_id = $specific_question_id";
        $result = pg_query($db_conn, $query);

        $query = "SELECT updateAttemptCount($specific_question_id)";
        $result = pg_query($db_conn, $query);
        die();
    }
    /*echo json_encode("asdsadas");
    die();*/
