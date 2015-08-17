<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // add row to cities database
        query("INSERT INTO cities (name, state, population, rent, walkscore, bikescore, transitscore) VALUES(?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)", $_POST["name"], $_POST["state"], $_POST["population"], $_POST["rent"], $_POST["walk"], $_POST["bike"], $_POST["transit"]);

        // get id of just-added entry
        $rows = query("SELECT LAST_INSERT_ID() AS id");
        $city_id = $rows[0]["id"];

        // increment user's number of cities
        query("UPDATE users SET numcities=numcities+1 WHERE id=?", $_SESSION["id"]);

        // get user's new number of cities
        $num = query("SELECT numcities FROM users WHERE id=?", $_SESSION["id"]);

        // add row to usercities database
        $rows = query("INSERT INTO usercities (user, city, rank) VALUES(?, ?, ?)", $_SESSION["id"], $city_id, $num[0]["numcities"]);

        // if user already had this city (and thus no new row added)
        if (!is_array($num_rows))
        {
            // undo incrementing number of cities
            query("UPDATE users SET numcities=numcities-1 WHERE id=?", $_SESSION["id"]);
        }

        // if we have the hidden POST parameter saying we came from adding a job
        if (!empty($_POST["id"]))
        {
            // redirect back to adding a job
            redirect("add_job.php?id=" . $_POST["id"] . "&city=" . $city_id);
        }

        // redirect to homepage
        redirect("/");
    }
    else
    {
        // if we have a GET parameter saying we came from adding a job
        if (!empty($_GET["id"]))
        {
            // render form passing id
            render("add_city_form.php", ["id" => $_GET["id"], "title" => "Add A City"]);
        }
        else
        {
            // render form
            render("add_city_form.php", ["title" => "Add A City"]);
        }
    }

?>
