<ul class="nav nav-tabs">
    <li<?php if ($template == "start.php"): ?> class="active"<?php endif ?>><a href="index.php">Home</a></li>
    <li<?php if ($template == "add_job_form.php"): ?> class="active"<?php endif ?>><a href="add_job.php">Add A Job</a></li>
    <li<?php if ($template == "search_cities_form.php" or $template == "search_cities_display" or $template == "add_city_form.php"): ?> class="active"<?php endif ?>><a href="search_cities.php">Search Cities</a></li>
    <li<?php if ($template == "change_password_form.php"): ?> class="active"<?php endif ?>><a href="change_password.php">Change Password</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>
<br/>
