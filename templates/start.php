<ul class="nav nav-pills">
    <li class="active"><a href="index.php">Home</a></li>
    <li><a href="add_job.php">Add A Job</a></li>
    <li><a href="add_city.php">Add A City</a></li>
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
                <th></th>
            </tr>
        </thead>
    <?php if (!empty($message)): ?>
    <tr><td colspan="8"><?= $message ?></td></tr>
    <?php endif ?>
    <?php if (!empty($cities)): ?>
    <form action="change_rank.php" method="post">
        <tbody>
        <?php foreach ($cities as $city): ?>
            <tr>
                <td><input name="<?= $city["id"] ?>" type="number" class="mod" min="1" max="<?= $user["numcities"] ?>" step="-1" onchange="this.form.submit()" onkeyup="this.form.submit()" value="<?= $city["rank"] ?>"></td>
                <td><?= $city["city_name"] ?></td>
                <td><?= $city["pop"] ?></td>
                <td>$<?= $city["rent"] ?></td>
                <td><?= $city["walk"] ?></td>
                <td><?= $city["bike"] ?></td>
                <td><?= $city["transit"] ?></td>
                <td><a class="x" href="remove_city.php?id=<?= $city["id"] ?>">X</a></td>
            </tr>
            <?php if (!empty($city["positions"])): ?>
            <tr>
                <td></td>
                <td colspan="6">
                    <table class="table table-condensed jobs">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Salary</th>
                                <th>Notes</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($city["positions"] as $position): ?>

                            <tr>
                                <td><?= $position["company"] ?></td>
                                <td><?= $position["position"] ?></td>
                                <td><?= $position["status"] ?></td>
                                <td>$<?= $position["salary"] ?></td>
                                <td><?= $position["notes"] ?></td>
                                <td><a href="edit_job.php?id=<?= $position["id"] ?>">Edit</a></td>
                            </tr>

                        <?php endforeach ?>
                        </tbody>
                    </table>
                </td>
                <td></td>
            </tr>
            <?php else: ?>
            <tr>
                <td></td>
                <td class="jobs" colspan="7">No jobs yet in this city.</td>
            </tr>
            <?php endif ?>
        <?php endforeach ?>
      </tbody>
    </form>
    <?php endif ?>
    </table>
</div>
