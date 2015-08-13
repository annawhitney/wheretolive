<ul class="nav nav-pills">
    <li><a href="index.php">Home</a></li>
    <li class="active"><a href="quote.php">Quote</a></li>
    <li><a href="buy.php">Buy</a></li>
    <li><a href="sell.php">Sell</a></li>
    <li><a href="history.php">History</a></li>
    <li><a href="change_password.php">Change Password</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<form action="quote.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus name="symbol" placeholder="Symbol" type="text"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Get Quote</button>
        </div>
    </fieldset>
</form>
