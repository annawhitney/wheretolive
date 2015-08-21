<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // add row to jobs database
        query("INSERT INTO jobs (user, city, company, position, salary, status, notes) VALUES(?, ?, ?, ?, ?, ?, ?)", $_SESSION["id"], $_POST["city"], $_POST["company"], $_POST["position"], $_POST["salary"], $_POST["status"], $_POST["notes"]);

        // redirect to main jobs list
        redirect("/");
    }
    else
    {
        // get user's list of cities
        $raw_cities = query("SELECT city FROM usercities WHERE user = ?", $_SESSION["id"]);

        // if user has no cities yet
        if (!is_array($raw_cities))
        {
            // render form with message
            render("add_job_form.php", ["message" => "You should <a href='search_cities.php'>search and add some cities</a> where your jobs are (or where you're looking for jobs) before you add a job.", "title" => "Add A Job"]);
        }
        else
        {
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

            // render form
            render("add_job_form.php", ["cities" => $cities,"title" => "Add A Job"]);
        }
    }

?>
