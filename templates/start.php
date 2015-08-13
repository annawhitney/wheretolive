<ul class="nav nav-pills">
    <li class="active"><a href="index.php">Home</a></li>
    <li><a href="add_job.php">Add A Job</a></li>
    <li><a href="cities.php">Cities</a></li>
    <li><a href="change_password.php">Change Password</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Rank</th>
                <th>City</th>
                <th>Population</th>
                <th>Median Rent</th>
                <th>WalkScore</th>
                <th>BikeScore</th>
                <th>TransitScore</th>
            </tr>
        </thead>
    </table>
    <?php foreach ($cities as $city): ?>
    <table class="table table-striped">
        <tbody>
            <tr>
                <td><?= $city["rank"] ?></td>
                <td><?= $city["city_name"] ?></td>
                <td><?= $city["pop"] ?></td>
                <td><?= $city["rent"] ?></td>
                <td><?= $city["walk"] ?></td>
                <td><?= $city["bike"] ?></td>
                <td><?= $city["transit"] ?></td>
            </tr>
        </tbody>
    </table>
    <?php if (!empty($city["positions"])): ?>
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Company</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($city["positions"] as $position): ?>

            <tr>
                <td><?= $position["company"] ?></td>
                <td><?= $position["position"] ?></td>
                <td><a href=/cities?city=<?= $position["city"] ?>><?= $position["city"] ?></a></td>
                <td>$<?= $position["salary"] ?></td>
                <td><?= $position["notes"] ?></td>
            </tr>

        <? endforeach ?>
    </table>
    <? endif ?>
    <? endforeach ?>
</div>
