<?php
  require('../db/config.php');
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
        <li><a href="#"> Editor Panel </a></li>
        <li class="link_with_symbol"><a href="#"> Challenges & Contests </a><img class="pp" src="../assets/party_popper.svg" width="16px"> </li>
    
      </ul>
    </nav>
    <hr>
    <div class="main_content">
    
     
      <button onclick="location.href='add_question.php'" class="button-28">Add New Coding Question</button>
      <button class="button-28">Add New Non-Coding Question</button>
      <button class="button-28">Add New Coding Question Solution</button>
      <button class="button-28">Add New Non-Coding Question Solution</button>
      <button class="button-28">Add New Coding Question Test Case</button>
      <button class="button-28">Add New Non-Coding Question Test Case</button>

    </div>
  </body>
</html>

