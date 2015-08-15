<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $dup_rank = 0;
        // check for two cities with same rank
        foreach (array_count_values($_POST) as $rank => $count)
        {
            if ($count == 2)
            {
                $dup_rank = $rank;
            }
        }

        if ($dup_rank !== 0)
        {
            // see which two cities have duplicate rank
            $switch_cities = array_keys(array_filter($_POST, function($v) use ($dup_rank) { return ($v == $dup_rank); }));

            // see which city originally had that rank
            foreach ($switch_cities as $city)
            {
                $rows = query("SELECT rank FROM usercities WHERE user = ? AND city = ?", $_SESSION["id"], $city);

                if ($rows[0]["rank"] == $dup_rank)
                {
                    $orig_city = $city;
                }
                else
                {
                    $new_city = $city;
                    $other_rank = $rows[0]["rank"];
                }
            }

            // update rows in usercities database
            query("UPDATE usercities SET rank = CASE WHEN city = ? THEN ?
                                                     WHEN city = ? THEN ?
                                                     ELSE rank
                                                END
                                                WHERE user = ?",
            $orig_city, $other_rank, $new_city, $dup_rank, $_SESSION["id"]);
        }

        // redirect to homepage
        redirect("/");
    }
    else
    {
        // redirect to homepage
        redirect("/");
    }

?>
