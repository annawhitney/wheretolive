<?php

    // configuration
    require("../includes/config.php"); 

    // get user info
    $users = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
    $user = $users[0];

    // get all cities associated with current user, ordered by rank
    $rows = query("SELECT * FROM usercities WHERE user = ? ORDER BY rank", $_SESSION["id"]);

    if (empty($rows))
    {
        // render with message saying you don't have any cities and should add some
        render("start.php", ["message" => "You haven't added any cities. <a href='search_cities.php'>Search for cities to add</a> to get started.", "title" => "Home"]);
        return;
    }

    $cities = [];
    foreach ($rows as $row)
    {
        $id = $row["city"];
        $city = query("SELECT * FROM cities WHERE id = ?", $id)[0];
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
                    "id" => $job["id"]
                ];
            }
        }

        $cities[] = [
            "id" => $id,
            "rank" => $row["rank"],
            "city_name" => $city_name,
            "pop" => number_format($city["population"], 0),
            "rent" => number_format($city["rent"], 0),
            "walk" => $city["walkscore"],
            "bike" => $city["bikescore"],
            "transit" => $city["transitscore"],
            "positions" => $positions
        ];
    }

    // render jobs
    render("start.php", ["user" => $user, "cities" => $cities, "title" => "Home"]);

?>
