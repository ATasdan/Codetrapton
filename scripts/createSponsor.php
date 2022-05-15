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
</head>

    <body>
        <div class = "createSponsor">
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
    </body>


</html>