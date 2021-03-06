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
            <p class="help-block">You can find this info using the Census Bureau's <a href=http://factfinder.census.gov/bkmk/table/1.0/en/ACS/12_5YR/B25064/312M100US418600606000>American FactFinder</a>. Click "Add/Remove Geographies" and search for your city.</p>
        </div>
        <div class="form-group">
            <label for="walk">You can look these up on the <a href="http://www.walkscore.com">WalkScore site</a>.</p>
            <input name="walk" placeholder="WalkScore" type="number" min="1"/>
            <input name="transit" placeholder="TransitScore" type="number" min="1"/>
            <input name="bike" placeholder="BikeScore" type="number" min="1"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Add City</button>
        </div>
    </fieldset>
</form>
