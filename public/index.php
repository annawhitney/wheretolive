<?php

    // configuration
    require("../includes/config.php"); 

    // get all cities associated with current user, ordered by rank
    $rows = query("SELECT * FROM usercities WHERE user = ? ORDER BY rank", $_SESSION["id"]);

    if ($rows === false)
    {
        // TODO: render with message saying you don't have any cities and should add some
    }

    $cities = [];
    foreach ($rows as $row)
    {
        $city = query("SELECT * FROM cities WHERE id = ?", $job["city"]);
        $city_name = $city[0]["name"] . ", " . $cities[0]["state"];
        
        // get all jobs belonging to current user in this city
        $jobs = query("SELECT * FROM jobs WHERE user = ? AND city = ?", $_SESSION["id"], $row);

        $positions = [];
        if ($jobs !== $false)
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
