<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a stock symbol to look up.");
        }

        $stock = lookup($_POST["symbol"]);

        if ($stock === false)
        {
            apologize("Invalid stock symbol.");
        }
        else
        {
            render("quote.php", ["stock" => $stock, "title" => "Quote for {$stock["name"]}"]);
        }
    }
    else
    {
        // else render form
        render("quote_form.php", ["title" => "Stock Quotes"]);
    }

?>
