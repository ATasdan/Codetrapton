<?php

require('../db/config.php');

$request = "";
if (isset($_POST['request'])) {
  $request = $_POST['request'];
}

// Fetch all records
if ($request == 'fetchall') {

  $query = "SELECT * FROM users";

  $result = pg_query($db_conn, $query);

  $response = array();

  while ($row = pg_fetch_assoc($result)) {

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

// Fetch record by id
if ($request == 'fetchbyid') {

  $userid = 0;
  if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
    $userid = $_POST['user_id'];
  }

  $query = "SELECT * FROM users WHERE user_id=" . $userid;
  $result = pg_query($con, $query);

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

  $query = "DELETE * FROM users WHERE user_id=" . $userid;
}
