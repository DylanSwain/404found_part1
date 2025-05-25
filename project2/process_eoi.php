<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $first_name = $_POST["first_name"];
    }

    echo "this is your name $first_name";
?>