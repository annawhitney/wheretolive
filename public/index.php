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

    $sharing = [];
    // see if anyone shared with this user
    $users = query("SELECT user FROM sharing WHERE shared = ?", $_SESSION["id"]);

    if (is_array($users))
    {
        foreach ($users as $s_user)
        {
            $name = query("SELECT username FROM users WHERE id = ?", $s_user["user"]);

            $sharing[] = [
                "id" => $s_user["user"],
                "username" => $name[0]["username"]
            ];
        }
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
                    "mine" => true,
                    "user" => $user["username"],
                    "company" => $job["company"],
                    "position" => $job["position"],
                    "status" => $job["status"],
                    "salary" => number_format($job["salary"], 2),
                    "notes" => $job["notes"],
                    "id" => $job["id"]
                ];
            }
        }

        // if other users have shared with current user, get their jobs too
        if (!empty($sharing))
        {
            foreach ($sharing as $share)
            {
                $s_jobs = query("SELECT * FROM jobs WHERE user = ? AND city = ?", $share["id"], $row["city"]);

                if (!empty($s_jobs))
                {
                    foreach ($s_jobs as $s_job)
                    {
                        $positions[] = [
                            "mine" => false,
                            "user" => $share["username"],
                            "company" => $s_job["company"],
                            "position" => $s_job["position"],
                            "status" => $s_job["status"],
                            "salary" => number_format($s_job["salary"], 2),
                            "notes" => $s_job["notes"],
                            "id" => $s_job["id"]
                        ];
                    }
                }
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
