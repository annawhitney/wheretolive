<form action="search_cities.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus name="name" placeholder="City Name" type="text">
        </div>
        <div class="form-group">
            <input name="state" placeholder="State" type="text">
        </div>
        <div class="form-group">
            <label for="population_min">Population</label>
            <input name="population_min" placeholder="Min" type="number" min="1"/>
            <input name="population_max" placeholder="Max" type="number"/>
        </div>
        <div class="form-group">
            <label for="rent_min">Median Rent</label>
            <input name="rent_min" placeholder="Min" type="number" min="1"/>
            <input name="rent_max" placeholder="Max" type="number"/>
        </div>
        <div class="form-group">
            <label for="order_by">Order results by:</label>
            <select name="order_by">
                <option value="name">Name</option>
                <option value="state">State</option>
                <option value="population">Population</option>
                <option value="rent">Median Rent</option>
                <option value="walkscore">WalkScore</option>
                <option value="transitscore">TransitScore</option>
                <option value="bikescore">BikeScore</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Search Cities</button>
        </div>
    </fieldset>
</form>
