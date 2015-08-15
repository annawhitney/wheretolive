<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // update job in jobs table
        query("UPDATE jobs SET company=?, position=?, salary=?, status=?, notes=? WHERE id=?", $_POST["company"], $_POST["position"], $_POST["salary"], $_POST["status"], $_POST["notes"], $_POST["id"]);

        // redirect to main jobs list
        redirect("/");
    }
    else
    {
        // if we don't know which job to edit
        if (empty($_GET["id"]))
        {
            apologize("Please select a job to edit from the homepage!");
        }
        else
        {
            // get the current job info from the database
            $rows = query("SELECT * FROM jobs WHERE id = ?", $_GET["id"]);

            // verify that something came back
            if ($rows === false)
            {
                apologize("No job under that ID!");
            }

            // get user's list of cities
            $raw_cities = query("SELECT city FROM usercities WHERE user = ?", $_SESSION["id"]);

            $cities = [];
            // get city names + states from list of ids
            foreach ($raw_cities as $city_id)
            {
                $names = query("SELECT name, state FROM cities WHERE id = ?", $city_id["city"]);

                $cities[] = [
                    "city_name" => $names[0]["name"] . ", " . $names[0]["state"],
                    "id" => $city_id["city"]
                ];
            }

            // render form with in-progress info
            render("edit_job_form.php", ["current" => $rows[0], "cities" => $cities, "title" => "Edit Job"]);
        }
    }

?>
