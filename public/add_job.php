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
        // if we have a GET parameter saying we came from adding a city
        if (!empty($_GET["id"])
        {
            // get the in-progress info from the database
            $rows = query("SELECT * FROM inprogress WHERE id = ?", $_GET["id"]);

            // verify that something came back
            if ($rows === false)
            {
                apologize("No query started under that ID!");
            }
            
            // get user's list of cities
            $raw_cities = query("SELECT city FROM usercities WHERE user = ?", $_SESSION["id"]);

            $cities = [];
            // get city names + states from list of ids
            foreach ($raw_cities as $city_id)
            {
                $names = query("SELECT name, state FROM cities WHERE id = ?", $city_id);

                $cities[] = [
                    "city_name" => $names[0]["name"] . ", " . $names[0]["state"],
                    "id" => $city_id
                ];
            }

            // render form with in-progress info
            render("add_job_form.php", ["inprogress" => $rows[0], "cities" => $cities, "title" => "Add A Job"]);
        }
        else
        {
            // get user's list of cities
            $raw_cities = query("SELECT city FROM usercities WHERE user = ?", $_SESSION["id"]);

            $cities = [];
            // get city names + states from list of ids
            foreach ($raw_cities as $city_id)
            {
                $names = query("SELECT name, state FROM cities WHERE id = ?", $city_id);

                $cities[] = [
                    "city_name" => $names[0]["name"] . ", " . $names[0]["state"],
                    "id" => $city_id
                ];
            }

            // render form
            render("add_job_form.php", ["cities" => $cities,"title" => "Add A Job"]);
        }
    }

?>
