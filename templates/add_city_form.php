<ul class="nav nav-pills">
    <li><a href="index.php">Home</a></li>
    <li ><a href="add_job.php">Add A Job</a></li>
    <li class="active"><a href="add_city.php">Add A City</a></li>
    <li><a href="change_password.php">Change Password</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<form action="add_city.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus name="name" placeholder="City Name" type="text" required>
        </div>
        <div class="form-group">
            <input autofocus name="state" placeholder="State" type="text" required>
        </div>
        <div class="form-group">
            <input name="population" placeholder="Population" type="number" min="1"/>
            <p class="help-block">Google or Wikipedia should know this.</p>
        </div>
        <div class="form-group">
            <input name="rent" placeholder="Median Rent" type="number" min="1"/>
            <p class="help-block">You can find this info using the Census Bureau's <a href=http://factfinder.census.gov/faces/tableservices/jsf/pages/productview.xhtml?pid=ACS_12_5YR_B25064&prodType=table>American FactFinder</a>. Click "Add/Remove Geographies" and search for your city.</p>
        </div>
        <div class="form-group">
            <input name="walk" placeholder="WalkScore" type="number" min="1"/>
            <p class="help-block">You can look this up on the <a href="walkscore.com">WalkScore site</a>.</p>
        </div>
        <div class="form-group">
            <input name="bike" placeholder="BikeScore" type="number" min="1"/>
            <p class="help-block">You can look this up on the <a href="walkscore.com">WalkScore site</a>.</p>
        </div>
        <div class="form-group">
            <input name="transit" placeholder="TransitScore" type="number" min="1"/>
            <p class="help-block">You can look this up on the <a href="walkscore.com">WalkScore site</a>.</p>
        </div>
        <?php if (!empty($id)): ?>
        <div class="form-group">
            <input type="hidden" value=<?= $id ?>/>
        </div>
        <? endif ?>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Add City</button>
        </div>
    </fieldset>
</form>
