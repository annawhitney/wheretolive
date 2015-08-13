<ul class="nav nav-pills">
    <li><a href="index.php">Home</a></li>
    <li class="active"><a href="add_job.php">Add A Job</a></li>
    <li ><a href="add_city.php">Add A City</a></li>
    <li><a href="change_password.php">Change Password</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<form action="add_job.php" method="post">
    <fieldset>
        <div class="form-group">
        <input autofocus name="company" placeholder="Company" type="text" <?php if (!empty($inprogress["company"])): ?>value=<?= $inprogress["company"] ?><? endif ?> required>
        </div>
        <div class="form-group">
            <input autofocus name="position" placeholder="Position" type="text" <?php if (!empty($inprogress["position"])): ?>value=<?= $inprogress["position"] ?><? endif ?> required>
        </div>
        <div class="form-group">
            <select name="city" required>
            <?php foreach ($cities as $city): ?>
                <option value=<?= $city["id"] ?>><?= $city["city_name"] ?></option>
            <? endforeach ?>
                <option value="new">Add A New City</option>
            </select>
        </div>
        <div class="form-group">
            <input name="salary" placeholder="Salary" type="number" min="1"/>
        </div>
        <div class="form-group">
            <textarea name="notes" rows="8" cols="60"><?php if (!empty($inprogress["notes"])): ?><?= $inprogress["notes"] ?><? endif ?></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Add Job</button>
        </div>
    </fieldset>
</form>
