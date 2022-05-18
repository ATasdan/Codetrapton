<?php

require('../db/config.php');

$request = "";
if (isset($_POST['request'])) {
  $request = $_POST['request'];
}
if ($request == 'fetcheditors') {
  $query = "SELECT DISTINCT * FROM public.view_editor_users ";

  $result = pg_query($db_conn, $query);

  $response = array();

  while ($row = pg_fetch_assoc($result)) {

    $user_id = $row['user_id'];
    $username = $row['username'];
    $fullname = $row['phone'];
    $email = $row['email'];

    $response[] = array(
      "user_id" => $user_id,
      "username" => $username,
      "fullname" => $fullname,
      "email" => $email,
    );
  }

  echo json_encode($response);
  die;
}
if ($request == 'fetchcompanies') {
  $query = "SELECT DISTINCT * FROM public.view_company_users ";

  $result = pg_query($db_conn, $query);

  $response = array();

  while ($row = pg_fetch_assoc($result)) {

    $user_id = $row['user_id'];
    $username = $row['username'];
    $email = $row['email'];

    $response[] = array(
      "user_id" => $user_id,
      "username" => $username,
      "email" => $email,
    );
  }

  echo json_encode($response);
  die;
}
// Fetch all records
if ($request == 'fetchall') {

  $query = "SELECT DISTINCT * FROM users WHERE type='developer' ";

  $result = pg_query($db_conn, $query);

  $response = array();

  while ($row = pg_fetch_assoc($result)) {

    $user_id = $row['user_id'];
    $username = $row['username'];
    $fullname = $row['phone'];
    $email = $row['email'];

    $response[] = array(
      "user_id" => $user_id,
      "username" => $username,
      "fullname" => $fullname,
      "email" => $email,
    );
  }

  echo json_encode($response);
  die;
}
// Fetch record by id
if ($request == 'seecommentofquestion') {

  $question_id = 0;
  if (isset($_POST['question_id']) && is_numeric($_POST['question_id'])) {
    $question_id = $_POST['question_id'];
  }

  $query = "SELECT * FROM comment WHERE question_id= '$question_id' ";
  $result = pg_query($db_conn, $query);

  $response = array();
  if (pg_numrows($result) > 0) {

    $row = pg_fetch_assoc($result);

    $user_id = $row['user_id'];
    $comment_body = $row['comment_body'];

    $response[] = array(
      "user_id" => $user_id,
      "comment_body" => $comment_body,
    );
  }

  echo json_encode($response);
  die;
}


// Fetch record by id
if ($request == 'fetchbyid') {

  $user_id = 0;
  if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
  }

  $query = "SELECT * FROM users WHERE user_id= '$user_id' ";
  $result = pg_query($db_conn, $query);

  $response = array();
  if (pg_numrows($result) > 0) {

    $row = pg_fetch_assoc($result);

    $user_id = $row['user_id'];
    $username = $row['username'];
    $fullname = $row['fullname'];
    $email = $row['email'];

    $response[] = array(
      "user_id" => $user_id,
      "username" => $username,
      "fullname" => $fullname,
      "email" => $email,
    );
  }

  echo json_encode($response);
  die;
}

if ($request == 'deletebyid') {

  $userid = 0;
  if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
    $userid = $_POST['user_id'];
  }

  $query = "DELETE FROM users WHERE user_id='$userid' ";
  $result = pg_query($db_conn, $query);

  $response = array();
  if (pg_numrows($result) > 0) {

    $row = pg_fetch_assoc($result);

    $user_id = $row['user_id'];
    $username = $row['username'];
    $fullname = $row['fullname'];
    $email = $row['email'];

    $response[] = array(
      "user_id" => $user_id,
      "username" => $username,
      "fullname" => $fullname,
      "email" => $email,
    );
  }

  echo json_encode($response);
  die;
}
