<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // if user submitted some cities
        if (!empty($_POST["to_add"]))
        {
            // get user's current number of cities
            $nums = query("SELECT numcities FROM users WHERE id=?", $_SESSION["id"]);
            $num = $nums[0]["numcities"];

            foreach ($_POST["to_add"] as $to_add)
            {
                // increment number of cities
                $num += 1;

                // add row to usercities database
                $rows = query("INSERT INTO usercities (user, city, rank) VALUES(?, ?, ?)", $_SESSION["id"], $to_add, $num);
            }

            // update user's number of cities
            query("UPDATE users SET numcities=? WHERE id=?", $num, $_SESSION["id"]);
        }

        // redirect to homepage
        redirect("/");
    }
    else
    {
        // redirect to homepage
        redirect("/");
    }

?>
