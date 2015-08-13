<ul class="nav nav-pills">
    <li><a href="index.php">Home</a></li>
    <li><a href="quote.php">Quote</a></li>
    <li><a href="buy.php">Buy</a></li>
    <li><a href="sell.php">Sell</a></li>
    <li><a href="history.php">History</a></li>
    <li class="active"><a href="change_password.php">Change Password</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<form action="change_password.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus name="password" placeholder="Current Password" type="password"/>
        </div>
        <div class="form-group">
            <input name="new_password" placeholder="New Password" type="password"/>
        </div>
        <div class="form-group">
            <input name="confirmation" placeholder="Confirm" type="password"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Change Password</button>
        </div>
    </fieldset>
</form>
