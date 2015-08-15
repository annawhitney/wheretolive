<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // if username field was left empty
        if (empty($_POST["username"]))
        {
            apologize("Please provide a username.");
        }

        // if password field was left empty
        else if (empty($_POST["password"]))
        {
            apologize("Please provide a password.");
        }

        // if password and confirmation did not match
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Password and confirmation did not match.");
        }

        // else insert user into database
        $query = query("INSERT INTO users (username, hash, numcities) VALUES(?, ?, 0)", $_POST["username"], crypt($_POST["password"]));

        // if query fails
        if ($query === false)
        {
            apologize("Could not register user.");
        }

        // else query succeeded
        else
        {
            // find id assigned to new user
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];

            // remember new user is logged in
            $_SESSION["id"] = $id;

            // redirect to portfolio
            redirect("/");
        }
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

?>
