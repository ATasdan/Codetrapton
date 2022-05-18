<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/533d2d342d.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/indexStyle.css" />
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
    <div class="sponsorPart">
        <div class="buttonContainer">
            <input type='button' value='Fetch All Developers' class="btn" id='but_fetchall'>
            <input type='button' value='Fetch All Companies' class="btn" id='but_fetch_companies'>
            <input type='button' value='Fetch All Editors' class="btn" id='but_fetch_editors'>
        </div>
        <div class="buttonContainer">
            <button onclick="viewComment()" class="btn" id="seecomments">See Comment</button>
            <input type='text' id='search' name='search' placeholder='Enter userid 1-8'>
            <input type='button' value='Search' class="btn" id='but_search'>
            <br />
        </div>
    </div>
    <table border="1" id="userTable" style="border-collapse: collapse;">
        <thread>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Name</th>
                <th>Phone</th>
            </tr>
        </thread>
    </table>

    <!-- Script--->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#but_fetch_companies').click(function() {
                $.ajax({
                    url: 'ajaxfile.php',
                    type: 'post',
                    data: {
                        request: 'fetchcompanies'
                    },
                    dataType: 'json',
                    success: function(response) {
                        createRowsForCompanies(response);
                    }
                });
            });

            $('#but_fetch_editors').click(function() {
                $.ajax({
                    url: 'ajaxfile.php',
                    type: 'post',
                    data: {
                        request: 'fetcheditors'
                    },
                    dataType: 'json',
                    success: function(response) {
                        createRows(response);
                    }
                });
            });

            $('#but_search').click(function() {
                var user_id = document.getElementById('search').value;
                if (!isNaN(user_id)) {
                    user_id = Number(user_id);
                } else {
                    user_id = -1;
                }

                if (user_id > -1) {
                    $.ajax({
                        url: 'ajaxfile.php',
                        type: 'post',
                        data: {
                            request: 'fetchbyid',
                            user_id: user_id
                        },
                        dataType: 'json',
                        success: function(response) {
                            createRows(response);
                        }
                    });
                }
            });

            $("#but_fetchall").click(function() {
                $.ajax({
                    url: 'ajaxfile.php',
                    type: 'post',
                    data: {
                        request: 'fetchall'
                    },
                    dataType: 'json',
                    success: function(response) {
                        createRows(response);
                    }
                });
            });
        });
        // Create table rows
        function createRows(response) {
            var len = 0;
            $('#userTable tbody').empty(); // Empty <tbody>
            if (response != null) {
                len = response.length;
            }
            var id_txt = "ID";
            var name_txt = "Name";
            var phone_txt = "Phone";
            var email_txt = "Email";
            var tr_str = "<tr id=>" +
                "<td align='center'>" + id_txt + "</td>" +
                "<td align='center'>" + name_txt + "</td>" +
                "<td align='center'>" + phone_txt + "</td>" +
                "<td align='center'>" + email_txt + "</td>" +
                "</tr>";

            $("#userTable tbody").append(tr_str);
            if (len > 0) {
                for (var i = 0; i < len; i++) {
                    var user_id = response[i].user_id;
                    var username = response[i].username;
                    var phone = response[i].fullname;
                    var email = response[i].email;

                    var tr_str = "<tr id= " + user_id + ">" +
                        "<td align='center'>" + user_id + "</td>" +
                        "<td align='center'>" + username + "</td>" +
                        "<td align='center'>" + phone + "</td>" +
                        "<td align='center'>" + email + "</td>" +
                        "<td align='center'> <button onClick='deleteFromTable(" + user_id + ")'>DELETE </button> </td>" +
                        "</tr>";

                    $("#userTable tbody").append(tr_str);
                }
            } else {
                var tr_str = "<tr>" +
                    "<td align='center' colspan='4'>No record found.</td>" +
                    "</tr>";

                $("#userTable tbody").append(tr_str);
            }
        }

        function createRowsForCompanies(response) {
            var len = 0;
            $('#userTable tbody').empty(); // Empty <tbody>
            if (response != null) {
                len = response.length;
            }
            var id_txt = "ID";
            var name_txt = "Name";
            var email_txt = "Email";
            var tr_str = "<tr id=>" +
                "<td align='center'>" + id_txt + "</td>" +
                "<td align='center'>" + name_txt + "</td>" +
                "<td align='center'>" + email_txt + "</td>" +
                "</tr>";

            $("#userTable tbody").append(tr_str);
            if (len > 0) {
                for (var i = 0; i < len; i++) {
                    var user_id = response[i].user_id;
                    var username = response[i].username;
                    var email = response[i].email;

                    var tr_str = "<tr id= " + user_id + ">" +
                        "<td align='center'>" + user_id + "</td>" +
                        "<td align='center'>" + username + "</td>" +
                        "<td align='center'>" + email + "</td>" +
                        "<td align='center'> <button onClick='deleteFromTable(" + user_id + ")'>DELETE </button> </td>" +
                        "</tr>";

                    $("#userTable tbody").append(tr_str);
                }
            } else {
                var tr_str = "<tr>" +
                    "<td align='center' colspan='4'>No record found.</td>" +
                    "</tr>";

                $("#userTable tbody").append(tr_str);
            }
        }
    </script>
    <script type="text/javascript">
        function deleteFromTable(id) {
            var a = "" + id;
            document.getElementById(a).style.display = "none";
            $.ajax({
                url: 'ajaxfile.php',
                type: 'post',
                data: {
                    request: 'deletebyid',
                    user_id: id
                },
                dataType: 'json',
                success: function(response) {
                    document.getElementById(id).hide(300);
                }
            });
        }

        function viewComment() {
            alert("232343");
            document.location.href = "viewComment.php";
        }

        function createComment() {
            alert("burası");
            document.location.href = "createComment.php";
        }
    </script>
</body>

</html>