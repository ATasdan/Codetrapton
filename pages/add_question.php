<?php
  session_start();
  $_SESSION["q_type"] = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
            <li><a href="editor.php"> Editor Panel </a></li>
            <li class="link_with_symbol"><a href="#"> Challenges & Contests </a><img class="pp"
                    src="../assets/party_popper.svg" width="16px"> </li>
        </ul>
    </nav>
    <hr>
    <div class="title_div">

        <i style="cursor: pointer; margin-left:50px;" onclick="location.href='editor.php'"
            class="fa-solid fa-angle-left"></i>
        <h1 class="page_title">Add New Problem</h1>
    </div>
    <div class="main_content">



        <div class="q-text-container">
            <form action="formhandler.php" method="POST" onsubmit=" formCheck(event)">

                <div style="display: flex; margin-bottom:20px">

                    <input type="radio" id="coding" value="Coding" name="q-t" />
                    <label for="coding">Coding Question</label>
                    <input type="radio" id="non-coding" value="Non-Coding" name="q-t" />
                    <label for="non-coding">Non-Coding Question</label>

                </div>
                <div>
                    <label style="margin: 20px" for="q-title">Question Title</label>

                    <textarea class="textfield" style="min-height: 2px; height:30px; padding: 7px 15px;" type="text"
                        id="q-title" name="q-title" placeholder="Type here.."> </textarea>
                </div>

                <div>
                    <label style="margin: 20px" for="q-prompt">Question Prompt</label>

                    <textarea class="textfield" style="min-height: 2px; height:100px; padding: 15px 20px;" type="text"
                        id="q-prompt" name="q-prompt" placeholder="Type here.."> </textarea>
                </div>

                <div>
                    <label style="margin: 20px" for="q-content">Question Content</label>

                    <textarea class="textfield" type="text" id="q-content" name="q-content"
                        placeholder="Type here.."> </textarea>


                </div>



                <ul class="q-selects">


                    <li>
                        <label for="difficulty">Difficulty</label>
                        <select id="difficulty" name="difficulty">
                            <option value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                        </select>
                    </li>


                    <li>

                        <label for="category">Category</label>
                        <select id="q-category" name="category">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </li>

                    <li>
                        <input type="checkbox" id="time-limit" name="time-limit" !checked />
                        <label for="time-limit">Time Limit</label>
                        <label style="visibility: hidden;" id="time-label" for="tl-quantity"> in mins </label>
                        <input style="visibility: hidden;" type="number" id="tl-quantity" name="tl-quantity" min="1"
                            max="180">
                    </li>

                    <li>
                        <input type="checkbox" id="is-premium" name="is-premium" !checked />
                        <label for="is-premium">Premium Question</label>
                    </li>

                    <li>
                        <input style="visibility:hidden" type="checkbox" id="is-multi" name="is-multi" !checked />
                        <label id="is-multi-lbl" style="visibility:hidden" for="is-multi">Multi-Choice Question</label>
                    </li>



                    <script>
                    function formCheck(event) {

                        flag = true;
                        if ($("#q-content").val().trim().length < 1) {
                            alert("Please enter question body...");
                            flag = false;
                            event.preventDefault();
                        }

                        if (!(document.getElementById("coding").checked || document.getElementById("non-coding")
                                .checked)) {
                            alert("Please fill in all details...");
                            flag = false;
                            event.preventDefault();
                        }

                        if (document.getElementById("time-limit").checked && document.getElementById("tl-quantity")
                            .value.length == 0) {
                            alert("Please fill in the time limit...");
                            flag = false;
                            event.preventDefault();
                        }

                        if (document.getElementById("q-title").value.length == 0) {
                            alert("Please fill in the question title...");
                            flag = false;
                            event.preventDefault();
                        }

                        if (document.getElementById("q-prompt").value.length == 0) {
                            alert("Please fill in the question prompt...");
                            flag = false;
                            event.preventDefault();
                        }


                    }

                    const checkbox = document.getElementById("time-limit");
                    const time_qty = document.getElementById("tl-quantity");
                    const time_label = document.getElementById("time-label");
                    const radio_coding = document.getElementById("coding");
                    const radio_ncoding = document.getElementById("non-coding");
                    checkbox.addEventListener("click", e => {
                            if (checkbox.checked) {
                                console.log("checked!");
                                time_qty.style.visibility = "visible";
                                time_label.style.visibility = "visible";
                            } else {
                                time_qty.style.visibility = "collapse";
                                time_label.style.visibility = "collapse";
                            }

                        }

                    );
                    const ismulti = document.getElementById("is-multi");
                    const ismultilbl = document.getElementById("is-multi-lbl");
                    radio_ncoding.addEventListener("click", function() {
                        console.log("n changed!");
                        if (radio_ncoding.checked) {
                            ismulti.style.visibility = "visible";
                            ismultilbl.style.visibility = "visible";
                        }
                    });

                    radio_coding.addEventListener("click", function() {

                        console.log("c changed!");
                        if (radio_coding.checked) {
                            ismulti.style.visibility = "hidden";
                            ismultilbl.style.visibility = "hidden";
                        }
                    })
                    </script>

                </ul>



                <input name="q-submit" class="submit_btn" type="submit" value="Submit">
            </form>




        </div>



    </div>
</body>

</html>