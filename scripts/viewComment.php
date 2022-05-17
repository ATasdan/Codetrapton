<!DOCTYPE html>
<hmtl lang="en">

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
        <div class="comments">
            <div class="btnContainer">
                <input type='text' id='questionid' name='questionid' placeholder='Enter q id'>
                <input type='button' value='View Comments' id='view_comments'>
            </div>
        </div>
        <table border="1" id="commentTable" style="border-collapse:collapse;">
            <thread>
                <tr>
                    <th>User ID</th>
                    <th>Comment</th>
                </tr>
            </thread>
        </table>



        <script type="text/javascript">
            $(document).ready(function() {
                $('#view_comments').click(function() {
                    var question_id = document.getElementById('questionid').value;
                    if (!isNaN(question_id)) {
                        question_id = Number(question_id);
                    } else {
                        question_id = -1;
                    }

                    if (question_id > -1) {
                        $.ajax({
                            url: 'ajaxfile.php',
                            type: 'post',
                            data: {
                                request: 'seecommentofquestion',
                                question_id: question_id
                            },
                            dataType: 'json',
                            success: function(response) {
                                createRows(response);
                            }
                        });
                    }
                });
            });

            function createRows(response) {
                var len = 0;
                $('#commentTable tbody').empty();
                if (response != null) {
                    len = response.length;
                }

                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var user_id = response[i].user_id;
                        var comment_body = response[i].comment_body;

                        var tr_str = "<tr id>" +
                            "<td align='center'>" + user_id + "</td>" +
                            "<td align='center'>" + comment_body +
                            "</tr>";

                        $("#commentTable tbody").append(tr_str);
                    }
                } else {
                    var tr_str = "<tr>" + "<td align='center' colspan='4'> No record found. </td>" +
                        "</tr>";
                    $("#commentTable tbody").append(tr_str);
                }
            }
        </script>
    </body>

</hmtl>