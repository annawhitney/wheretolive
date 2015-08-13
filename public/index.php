<?php

    // configuration
    require("../includes/config.php"); 

    // get all cities associated with current user, ordered by rank
    $rows = query("SELECT * FROM usercities WHERE user = ? ORDER BY rank", $_SESSION["id"]);

    if (empty($rows))
    {
        // render with message saying you don't have any cities and should add some
        render("start.php", ["message" => "You haven't added any cities. <a href='add_city.php'>Add a city</a> to get started.", "title" => "Jobs"]);
    }

    $cities = [];
    foreach ($rows as $row)
    {
        $city = query("SELECT * FROM cities WHERE id = ?", $row["city"])[0];
        $city_name = $city["name"] . ", " . $city["state"];
        
        // get all jobs belonging to current user in this city
        $jobs = query("SELECT * FROM jobs WHERE user = ? AND city = ?", $_SESSION["id"], $row["city"]);

        $positions = [];
        if (!empty($jobs))
        {
            foreach ($jobs as $job)
            {
                $positions[] = [
                    "company" => $job["company"],
                    "position" => $job["position"],
                    "status" => $job["status"],
                    "salary" => number_format($job["salary"], 2),
                    "notes" => $job["notes"],
                ];
            }
        }

        $cities[] = [
            "rank" => $row["rank"],
            "city_name" => $city_name,
            "pop" => $city["population"],
            "rent" => $city["rent"],
            "walk" => $city["walkscore"],
            "bike" => $city["bikescore"],
            "transit" => $city["transitscore"],
            "positions" => $positions
        ];
    }

    // render jobs
    render("start.php", ["cities" => $cities, "title" => "Jobs"]);

?>
