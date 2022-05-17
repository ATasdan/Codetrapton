<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/533d2d342d.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/companyStyle.css" />
    <title>Codeatrapton</title>
</head>

<body>
    <?php
        require('../db/config.php');
        $company_id = $_GET['user_id'];
        $query = "SELECT username FROM users WHERE user_id = $company_id;";
        $result = pg_query($db_conn,$query);
        $row = pg_fetch_assoc($result);
        $username = $row['username'];
    ?>
    <nav>
        <div class="logo">
            <h2>codeatrapton</h2>
            <img src="../assets/monkey.jpg">
        </div>

        <div class="navMenu">
            <div class="interviewsNav">
                <h3>Interviews</h3>
                <i class="fa-solid fa-comments"></i>
            </div>

            <div class="contestsNav">
                <h3>Challenges & Contests</h3>
                <i class="fa-solid fa-paperclip"></i>
            </div>
        </div>

        <div class="userMenu">
            <div class="userBox">
                <i class="fa-solid fa-shield"></i>
                <?php
                    echo "<h3>$username</h3>";
                ?>
            </div>

            <div class="logoutBox">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <h3>logout</h3>
            </div>
        </div>
    </nav>

    <div class="showcase">
        <button id="createButton" class="btn">create interview</button>
        <?php
            echo "<div class=\"list\">";
            $query = "SELECT * FROM interview WHERE company_id = $company_id;";
            $result = pg_query($db_conn,$query);
            if(pg_num_rows($result) == 0){
                echo "<h2>You have not sent any interview questions yet</h2><hr width=\"100%\">";
            }
            else{
                echo "<h1> Your Interviews </h1><hr width=\"100%\">"; 
                for($i = 0; $i < pg_num_rows($result); $i++){
                    $row = pg_fetch_assoc($result);
                    $query = "SELECT * FROM users WHERE user_id = ".$row['interviewee_id'].";";
                    $userResult = pg_query($db_conn,$query);
                    $interviewee_name = "";
                    $interviewResult = "";
                    $interviewResultStyle = "";
                    if(!$row['is_answer_correct']){
                        $interviewResult = "Not attempted";
                        $resultStyle = "color:grey";
                    }
                    elseif($row['is_answer_correct'] == "true"){
                        $interviewResult = "Passed";
                        $resultStyle = "color:green";
                    }
                    else{
                        $interviewResult = "Failed";
                        $resultStyle = "color:red";
                    }
                    while($userRow = pg_fetch_assoc($userResult)){
                        $interviewee_name = $userRow['username'];
                    }
        
                    $html = "<div class=\"listContainer\"><h3>Interview with $interviewee_name,Result: <span style=\"$resultStyle\">$interviewResult</span></h3></div>";
                    echo $html;
                }
                echo "</div>";
            }
        ?>
    </div>

    <div id="overlay" class="overlay" style="display:none">
        <div id="modal" class="modal">
            <i class="fa-solid fa-xmark" id="cancelButton" style="align-self:flex-end;cursor:pointer"></i>
            <h1>Create an Interview</h1>
            <hr width="100%">
            <div class="questionBtns">
                <form id="radioForm" action="company.php" name="btns" method="POST">
                    <div class="radioDiv">
                        <input type="radio" id="nonCoding" name="qType" value="nonCoding" checked/>
                        <label for="nonCoding">Non-Coding Question</label>
                    </div>
                    <div class="radioDiv">
                        <input type="radio" id="coding" name="qType" value="coding" />
                        <label for="coding">Coding Question</label>
                    </div>
                </form>
            </div>
            <hr width="100%">
            <div class="nonCoding" id="nonCodingDiv">
                <div>
                    <?php
                        echo "<form style=\"display:flex;flex-direction:column;justify-content:center;align-items:center\" action=\"company.php?user_id=$company_id\" method=\"POST\">";
                    ?>
                        <div class="fieldContainer">
                            <input class="textInput" placeholder="enter question"type="text" name="ncTitle" id="ncTitle" required/>
                        </div>
                        <input type="hidden" value="nonCoding" name="qType"/>
                        <hr width="100%">
                        <div class="fieldContainer">
                            <input type="radio" id="choiceA" name="choice" value="a" checked/>
                            <input class="textInput" placeholder="enter choice"type="text" name="answerA" id="answerA" required/>
                        </div>
                        <div class="fieldContainer">
                            <input type="radio" id="choiceB" name="choice" value="b"/>
                            <input class="textInput" placeholder="enter choice"type="text" name="answerB" id="answerB" required/>
                        </div>
                        <div class="fieldContainer">
                            <input type="radio" id="choiceC" name="choice" value="c"/>
                            <input class="textInput" placeholder="enter choice"type="text" name="answerC" id="answerC" required/>
                        </div>
                        <div class="fieldContainer">
                            <input type="radio" id="choiceD" name="choice" value="d"/>
                            <input class="textInput" placeholder="enter choice"type="text" name="answerD" id="answerD" required/>
                        </div>
                        
                        <hr width="100%">
                        <h4 style="padding:15px;margin:0">Select User</h4>
                        <select id="userList" name="userList">
                        <?php
                            $query = "SELECT username,user_id FROM users WHERE type='developer';";
                            $result = pg_query($db_conn,$query);
                            $html = "";
                            while($row = pg_fetch_assoc($result)){
                                $html = $html. "<option value=\"".$row['user_id']."\">".$row['username']."</option>";
                            }
                            $html = $html . "</select>";
                            echo $html;
                        ?>
                        <button style="margin-top:10px" type="submit" class="btn">submit</button>
                    </form>
                </div>
            </div>
            
            <div style="display:none" class="coding" id="codingDiv">
                    <?php
                        echo "<form style=\"display:flex;flex-direction:column;justify-content:center;align-items:center\" action=\"company.php?user_id=$company_id\" method=\"POST\">";
                    ?>

                    <input type="hidden" value="coding" name="qType"/>
                    <textarea class="textArea" name="cQuestion" id="cQuestion" cols="50" rows="4" placeholder="enter question" required></textarea>
                    <hr width="100%">
                    <textarea class="textArea" name="cSolution" id="cSolution" cols="50" rows="7" placeholder="enter solution" required></textarea>

                    <hr width="100%">
                    <h4 style="padding:15px;margin:0">Select User</h4>
                    <select id="userList" name="userList">
                    <?php
                        $query = "SELECT username,user_id FROM users WHERE type='developer';";
                        $result = pg_query($db_conn,$query);
                        $html = "";
                        while($row = pg_fetch_assoc($result)){
                            $html = $html. "<option value=\"".$row['user_id']."\">".$row['username']."</option>";
                        }
                        $html = $html . "</select>";
                        echo $html;
                    ?>
                    <button style="margin-top:10px" type="submit" class="btn">submit</button>
                </form>
            </div>

            <?php
                if(isset($_POST["ncTitle"]) || isset($_POST["cQuestion"])){
                    $interviewee_id = $_POST["userList"];
                    $date = date_format(new DateTime(),'d-m-y');
                    if($_POST["qType"] == "nonCoding"){
                        $question_prompt = $_POST["ncTitle"];
                        $choiceA = $_POST["answerA"];
                        $choiceB = $_POST["answerB"];
                        $choiceC = $_POST["answerC"];
                        $choiceD = $_POST["answerD"];
                        $answer = $_POST["choice"];

                        $query = "INSERT INTO interview (interviewee_id,company_id,question_type,created_at,question_prompt,nc_question_choice_a,nc_question_choice_b,nc_question_choice_c,nc_question_choice_d,nc_question_choice_correct) VALUES ($interviewee_id,$company_id,'nonCoding','$date','$question_prompt','$choiceA','$choiceB','$choiceC','$choiceD','$answer');";
                    }
                    elseif($_POST["qType"] == "coding"){
                        $question_prompt = $_POST["cQuestion"];
                        $question_answer = $_POST["cSolution"];
                        
                        $query = "INSERT INTO interview (interviewee_id,company_id,question_type,created_at,question_prompt,c_question_solution) VALUES ($interviewee_id,$company_id,'coding','$date','$question_prompt','$question_answer');";
                    }

                    $result = pg_query($db_conn,$query);
                }
            ?>
        </div>
    </div>
    

    <script src="../scripts/companyScript.js"></script>
</body>