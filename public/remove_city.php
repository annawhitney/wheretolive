<?php

    // configuration
    require("../includes/config.php"); 

    // if city id included in request
    if (!empty($_GET["id"]))
    {
        // delete row from usercities database and get rank
        query("DELETE FROM usercities WHERE user = ? AND city = ? AND IFNULL(rank, 0) = LAST_INSERT_ID(rank)", $_SESSION["id"], $_GET["id"]);
        $rows = query("SELECT LAST_INSERT_ID() AS id");
        $old_rank = $rows[0]["id"];

        // update rows in usercities database
        query("UPDATE usercities SET rank = CASE WHEN rank > ? THEN rank - 1
                                                 ELSE rank
                                            END
                                            WHERE user = ?",
              $old_rank, $_SESSION["id"]);

        // decrease user's number of cities by one
        query("UPDATE users SET numcities = numcities - 1 WHERE id = ?", $_SESSION["id"]);

        // redirect to homepage
        redirect("/");
    }
    else
    {
        // redirect to homepage
        redirect("/");
    }

?>
