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
    <div class="sponsorPart">
        <div class="btnContainer">
            <button onclick="sponsor()" class="btn" id="sponsorBtn">sponsor</button>
            <button onclick="nextPage()" class="btn" id="gotonextPage">sponsor</button>
            <input type='text' id='search' name='search' placeholder='Enter userid 1-8'>
            <input type='button' value='Search' id='but_search'>
            <br/>
            <input type='button' value='Fetch all records' id='but_fetchall'>
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
        <tbody>

        </tbody>
    </table>

    <!-- Script--->
    <script type="text/javascript">

        $(document).ready(function(){
            $('#but_search').click(function(){
                var user_id = $('search').val().trim();
                if(!isNaN(user_id)){
                    user_id = Number(user_id);
                }
                else{
                    user_id = -1;
                }

                if(user_id > -1){
                    $.ajax({
                        url: 'ajaxfile.php',
                        type:'post',
                        data:{request: 'fetchbyid', user_id: user_id},
                        dataType: 'json',
                        success: function(response){
                            createRows(response);
                        }
                    });
                }
            });

            $("#but_fetchall").click(function(){
                $.ajax({
                    url: 'ajaxfile.php',
                    type:'post',
                    data:{request: 'fetchall'},
                    dataType: 'json',
                    success: function(response){
                        createRows(response);                        
                    }
                });
            });
        });
        // Create table rows
        function createRows(response){
            var len = 0;
            $('#userTable tbody').empty(); // Empty <tbody>
            if(response != null){
                len = response.length;
            }

            if(len > 0){
                for(var i=0; i<len; i++){
                    var id = response[i].user_id;
                    var username = response[i].username;
                    var fullname = response[i].fullname;
                    var email = response[i].email;

                    var tr_str = "<tr>" +
                    "<td align='center'>" + id + "</td>" +
                    "<td align='center'>" + username + "</td>" +
                    "<td align='center'>" + fullname + "</td>" +
                    "<td align='center'>" + email + "</td>" +
                    "</tr>";

                    $("#userTable tbody").append(tr_str);
                }
            }else{
                var tr_str = "<tr>" +
                "<td align='center' colspan='4'>No record found.</td>" +
                "</tr>";
            
                $("#userTable tbody").append(tr_str);
            }
        }
    </script>
</body>


<script type="text/javascript">
    function sponsor(){
        alert('you have clicked me');
    }

    function nextPage(){
        document.location.href="scripts/createSponsor.php";
    }
</script>
</html>