<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // if user wants to add a new city
        if ($_POST["city"] == "new")
        {
            // add row to query-in-progress database
            query("INSERT INTO inprogress (user, company, position, salary, notes) VALUES(?, ?, ?, ?, ?, ?)", $_SESSION["id"], $_POST["company"], $_POST["position"], $_POST["salary"], $_POST["notes"]);

            // get id of just-added entry
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];

            // redirect to add-a-city page with id as get parameter
            redirect("/add_city.php?id=" . $id)
        }
        
        // add row to jobs database
        query("INSERT INTO jobs (user, city, company, position, salary, notes) VALUES(?, ?, ?, ?, ?, ?)", $_SESSION["id"], /* TODO: figure out how to handle city */, $_POST["company"], $_POST["position"], $_POST["salary"], $_POST["notes"]);

        // redirect to main jobs list
        redirect("/");
    }
    else
    {
        // if we have a GET parameter saying we came from adding a job
        if (!empty($_GET["id"])
        {
            // render form passing id
            render("add_city_form.php", ["id" = $_GET["id"], "title" => "Add A City"]);
        }
        else
        {
            // render form
            render("add_city_form.php", ["title" => "Add A City"]);
        }
    }

?>
