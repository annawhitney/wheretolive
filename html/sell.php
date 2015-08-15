<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must select a stock to sell.");
        }
        else if (empty($_POST["shares"]))
        {
            apologize("You must select a number of shares to sell.");
        }
        
        // query stocks database to find quantity of selected stock
        $stock_shares = query("SELECT shares FROM stocks WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        $shares = $stock_shares[0]["shares"];

        // look up stock
        $stock = lookup($_POST["symbol"]);

        // if picked more shares than you have
        if ($_POST["shares"] > $shares)
        {
            apologize("You do not own that many shares of that stock.");
        }

        // else if picked fewer shares than you have
        else if ($_POST["shares"] < $shares)
        {
            // update row of stocks database
            query("UPDATE stocks SET shares = shares - ? WHERE id = ? AND symbol = ?", $_POST["shares"], $_SESSION["id"], $_POST["symbol"]);

            // add row to log database
            $date = date('Y-m-d H:i:s');
            query("INSERT INTO log (id, transaction, symbol, shares, price, date_time) VALUES (?, 'SOLD', ?, ?, ?, ?)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"], $stock["price"], $date);

            // credit user proceeds of sale
            $proceeds = $_POST["shares"] * $stock["price"];
            query("UPDATE users SET cash = cash + ? WHERE id = ?", $proceeds, $_SESSION["id"]);
            
            // redirect to portfolio
            redirect("/");
        }

        // else if picked same number of shares that you have
        else if ($_POST["shares"] = $shares)
        {
            // delete row from stocks database
            query("DELETE FROM stocks WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);

            // add row to log database
            $date = date('Y-m-d H:i:s');
            query("INSERT INTO log (id, transaction, symbol, shares, price, date_time) VALUES (?, 'SOLD', ?, ?, ?, ?)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"], $stock["price"], $date);

            // credit user proceeds of sale
            $stock = lookup($_POST["symbol"]);
            $proceeds = $_POST["shares"] * $stock["price"];
            query("UPDATE users SET cash = cash + ? WHERE id = ?", $proceeds, $_SESSION["id"]);
            
            // redirect to portfolio
            redirect("/");
        }
    }
    else
    {
        // query stocks database to find list of current stocks owned
        $stocks = query("SELECT symbol FROM stocks WHERE id = ?", $_SESSION["id"]);

        // render form
        render("sell_form.php", ["stocks" => $stocks,"title" => "Sell"]);
    }

?>
