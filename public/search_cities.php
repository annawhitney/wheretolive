<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // build query based on submitted fields
        $query = "SELECT * FROM cities";
        $args = [];
        $first = true;

        if (!empty($_POST["name"]))
        {
            $query .= " WHERE name LIKE '?%'";
            $args[] = $_POST["name"];
            $first = false;
        }

        if (!empty($_POST["state"]))
        {
            if ($first === false)
            {
                $query .= " AND state=?";
            }
            else
            {
                $query .= " WHERE state=?";
                $first = false;
            }
            $args[] = $_POST["state"];
        }

        if (!empty($_POST["population_min"]))
        {
            if ($first === false)
            {
                $query .= " AND population > ?";
            }
            else
            {
                $query .= " WHERE population > ?";
                $first = false;
            }
            $args[] = $_POST["population_min"];
        }

        if (!empty($_POST["population_max"]))
        {
            if ($first === false)
            {
                $query .= " AND population < ?";
            }
            else
            {
                $query .= " WHERE population < ?";
                $first = false;
            }
            $args[] = $_POST["population_max"];
        }

        if (!empty($_POST["rent_min"]))
        {
            if ($first === false)
            {
                $query .= " AND rent > ?";
            }
            else
            {
                $query .= " WHERE rent > ?";
                $first = false;
            }
            $args[] = $_POST["rent_min"];
        }

        if (!empty($_POST["rent_max"]))
        {
            if ($first === false)
            {
                $query .= " AND rent < ?";
            }
            else
            {
                $query .= " WHERE rent < ?";
                $first = false;
            }
            $args[] = $_POST["rent_max"];
        }

        // order by given field (default is 'name')
        $query .= " ORDER BY ?";
        $args[] = $_POST["order_by"];

        // prepend query to list of args
        array_unshift($args, $query);

        // get cities matching given params from database
        $rows = call_user_func_array("query", $args);

        $cities = [];
        // see whether user has each city yet
        foreach ($rows as $row)
        {
            $has = query("SELECT * FROM usercities WHERE user = ? AND city = ?", $_SESSION["id"], $row["id"]);

            $cities[] = [
                "user_has" => !empty($has),
                "id" => $row["id"],
                "name" => $row["name"],
                "state" => $row["state"],
                "population" => $row["population"],
                "rent" => $row["rent"],
                "walkscore" => $row["walkscore"],
                "bikescore" => $row["bikescore"],
                "transitscore" => $row["transitscore"]
            ];
        }

        // redirect to homepage
        render("search_cities_display.php", ["cities" => $cities, "title" => "Search Results"]);
    }
    else
    {
        // render form
        render("search_cities_form.php", ["title" => "Search Cities"]);
    }

?>
