<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // look up shared user
        $user = query("SELECT id FROM users WHERE username = ?", $_POST["username"]);

        if (!is_array($user))
        {
            apologize("No user by that username. Check your spelling and <a href='sharing.php'>try again</a>.");
        }

        // add row to sharing database
        query("INSERT INTO sharing (user, shared) VALUES(?, ?)", $_SESSION["id"], $user[0]["id"]);

        // redirect to homepage
        redirect("/");
    }
    else
    {
        // render form
        render("sharing_form.php", ["title" => "Share"]);
    }

?>
