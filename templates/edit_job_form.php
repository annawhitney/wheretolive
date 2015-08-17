<ul class="nav nav-pills">
    <li><a href="index.php">Home</a></li>
    <li><a href="add_job.php">Add A Job</a></li>
    <li><a href="add_city.php">Add A City</a></li>
    <li><a href="change_password.php">Change Password</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<form action="edit_job.php" method="post">
    <fieldset>
        <div class="form-group">
        <input autofocus name="company" placeholder="Company" type="text" <?php if (!empty($current["company"])): ?>value="<?= $current["company"] ?>"<?php endif ?> required>
        </div>
        <div class="form-group">
            <input name="position" placeholder="Position" type="text" <?php if (!empty($current["position"])): ?>value="<?= $current["position"] ?>"<?php endif ?> required>
        </div>
        <div class="form-group">
            <select name="city" required>
            <?php foreach ($cities as $city): ?>
                <option value=<?= $city["id"] ?> <?php if (!empty($current["city"])): ?><?php if ($city["id"] == $current["city"]): ?>selected<?php endif ?><?php endif ?>><?= $city["city_name"] ?></option>
            <?php endforeach ?>
                <option value="new">Add A New City</option>
            </select>
        </div>
        <div class="form-group">
            <select name="status">
                <option value="">Job Status</option>
                <option value="">------</option>
                <option value="interested" <?php if (!empty($current["status"])): ?><?php if ($current["status"] == "interested"): ?>selected<?php endif ?><?php endif ?>>Interested</option>
                <option value="applied" <?php if (!empty($current["status"])): ?><?php if ($current["status"] == "applied"): ?>selected<?php endif ?><?php endif ?>>Applied</option>
                <option value="interview" <?php if (!empty($current["status"])): ?><?php if ($current["status"] == "interview"): ?>selected<?php endif ?><?php endif ?>>Interview</option>
                <option value="second" <?php if (!empty($current["status"])): ?><?php if ($current["status"] == "second"): ?>selected<?php endif ?><?php endif ?>>Second Round</option>
                <option value="offer" <?php if (!empty($current["status"])): ?><?php if ($current["status"] == "offer"): ?>selected<?php endif ?><?php endif ?>>Offer</option>
                <option value="other" <?php if (!empty($current["status"])): ?><?php if ($current["status"] == "other"): ?>selected<?php endif ?><?php endif ?>>Other (specify in notes)</option>
            </select>
        </div>
        <div class="form-group">
            <input name="salary" placeholder="Salary" type="number" min="1" <?php if (!empty($current["salary"])): ?>value="<?= $current["salary"] ?>"<?php endif ?>/>
        </div>
        <div class="form-group">
            <textarea name="notes" rows="5" cols="30"><?php if (!empty($current["notes"])): ?><?= $current["notes"] ?><?php else: ?>Enter notes here<?php endif ?></textarea>
        </div>
        <div class="form-group">
            <input name="id" type="hidden" value="<?= $current["id"] ?>"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Edit Job</button>
        </div>
    </fieldset>
</form>
<form action="delete_job.php" method="post">
    <fieldset>
        <div class="form-group">
            <input name="id" type="hidden" value="<?= $current["id"] ?>"/>
        </div>
        <div class="form-group">
            <label>or</label>
            <button type="submit" class="btn btn-danger btn-sm">Delete Job</button>
        </div>
    </fieldset>
</form>
