<ul class="nav nav-pills">
    <li><a href="index.php">Home</a></li>
    <li><a href="quote.php">Quote</a></li>
    <li><a href="buy.php">Buy</a></li>
    <li class="active"><a href="sell.php">Sell</a></li>
    <li><a href="history.php">History</a></li>
    <li><a href="change_password.php">Change Password</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <select name="symbol">
                <option value=''> </option>
            <?php foreach ($stocks as $stock) : ?>

                <option value='<?= $stock["symbol"] ?>'><?= $stock["symbol"] ?></option>

            <? endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <input name="shares" placeholder="Shares" type="number" min="1"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Sell</button>
        </div>
    </fieldset>
</form>
