<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // remove job from jobs table
        query("DELETE FROM jobs WHERE id=?", $_POST["id"]);

        // redirect to main jobs list
        redirect("/");
    }
    else
    {
        redirect("/");
    }
?>
