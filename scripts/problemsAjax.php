<?php
require('../db/config.php');


//echo("<script>console.log('PHP: " . $data . "');</script>");


if (!empty($_POST['request'])) {
    $request = $_POST['request'];

    if ($request == 'question') {
        $query = "SELECT * FROM question";
    } else {
        $query = "SELECT * FROM question WHERE question_nature= '$request' ";
    }
    $result = pg_query($db_conn, $query);
}
?>

<table class="table table-bordered" id="question-table">
    <?php
    if (pg_num_rows($result)) {
    ?>
        <thead>
            <th col-index=1>Title
                <select class="table-filter" id="" onchange="filter_rows()">
                    <option value="all"></option>
                </select>
            </th>

            <th col-index=2>Ranking
                <select class="table-filter" id="" onchange="filter_rows()">
                    <option value="all"></option>
                </select>
            </th>
            <th col-index=3>Attemps
                <select class="table-filter" id="" onchange="filter_rows()">
                    <option value="all"></option>
                </select>
            </th>
            <th col-index=4>Difficulty
                <select class="table-filter" id="" onchange="filter_rows()">
                    <option value="all"></option>
                </select>
            </th>
            <th col-index=5>Type
                <select class="table-filter" id="" onchange="filter_rows()">
                    <option value="all"></option>
                </select>
            </th>
            <th col-index=6>PREMIUM
                <select class="table-filter" id="" onchange="filter_rows()">
                    <option value="all"></option>
                </select>
            </th>

            <th>&hearts;</th>

        <?php
    } else {
        echo "Sorry no records have found";
    }
        ?>
        </thead>

        <tbody>
            <?php
            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>
                    <td>" . $row['question_title'] . "</td>
                    <td> DEFAULT </td>
                    <td> 0</td>
                    <td>" . $row["difficulty"] . " </td>
                    <td>" . $row["question_type"] . " </td>
                    <td>" . $row["is_premium"] . " </td>
                    <td>
                        <a class = 'btn btn-primary btn-sm' href = './specific_problem_page.php?question_id=" . $row['question_id'] . "'> SOLVE</a>
                          <a class = 'btn btn-primary btn-sm' href = 'like'> Like</a>
                          <a class = 'btn btn-danger btn-sm' href = 'dislike'> Dislike</a>    
                     </td>
                </tr>";
            }
            ?>
            <script>
                getUniqueValuesFromColumn()
            </script>
        </tbody>
</table>