<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>City</th>
                <th>State</th>
                <th>Population</th>
                <th>Median Rent</th>
                <th>WalkScore</th>
                <th>BikeScore</th>
                <th>TransitScore</th>
            </tr>
        </thead>
    <?php if (!empty($cities)): ?>
        <tbody>
        <form action="add_cities.php" method="post">
        <?php foreach ($cities as $city): ?>
            <tr>
            <td><?php if ($city["user_has"] === false): ?><input name="to_add[]" value="<?= $city["id"] ?>" type="checkbox"/><?php endif ?></td>
                <td><?= $city["name"] ?></td>
                <td><?= $city["state"] ?></td>
                <td><?= number_format($city["population"], 0) ?></td>
                <td>$<?= number_format($city["rent"], 0) ?></td>
                <td><?= $city["walkscore"] ?></td>
                <td><?= $city["bikescore"] ?></td>
                <td><?= $city["transitscore"] ?></td>
            </tr>
        <?php endforeach ?>
            <tr>
                <td colspan="8"><button type="submit" class="btn btn-default">Add Checked Cities</button></td>
            </tr>
        </form>
        <?php endif ?>
            <tr>
                <td colspan="8">Or <a href="add_city.php">add a new city</a> that's not in our database yet.</td>
            </tr>
        </tbody>
    </table>
</div>
