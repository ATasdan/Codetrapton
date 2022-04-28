<?php
    $connectionString = "postgres://mrutglhlxpxpwi:2e079d4b99acd29378091e7b9471a1ef3040539db5c615d942f5774b2b556017@ec2-34-194-158-176.compute-1.amazonaws.com:5432/deacap1jo5th24";
    $port=5432;
    $username="mrutglhlxpxpwi";
    $password="2e079d4b99acd29378091e7b9471a1ef3040539db5c615d942f5774b2b556017";
    $db_conn = pg_connect("host=$connectionString port=$port dbname=$deacap1jo5th24 user=$username password=$password");

    if(!$db_conn){
        echo "Cannot connect to database";
    }
?>