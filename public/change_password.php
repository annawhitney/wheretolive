<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // if password field was left empty
        if (empty($_POST["password"]))
        {
            apologize("Please provide your current password.");
        }

        // if password did not match current password
        $row = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        if (crypt($_POST["password"], $row[0]["hash"]) == $row[0]["hash"])
        {
            // if new password field was left empty
            if (empty($_POST["new_password"]))
            {
                apologize("Please enter a new password.");
            }

            // if new password and confirmation did not match
            else if ($_POST["new_password"] != $_POST["confirmation"])
            {
                apologize("New password and confirmation did not match.");
            }

            // change user's password in database
            $query = query("UPDATE users SET hash = ? WHERE id = ?", crypt($_POST["new_password"]), $_SESSION["id"]);

            // redirect to portfolio
            redirect("/");
        }
        else
        {
            apologize("Incorrect current password.");
        }
    }
    else
    {
        // else render form
        render("change_password_form.php", ["title" => "Change Password"]);
    }

?>
