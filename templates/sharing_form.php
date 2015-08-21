<p>You can share all your job data with another user. They will only see jobs of yours in cities on their list, however. In future, we hope to add support for sharing of individual jobs and cities; however, for the moment, sharing is jobs only and all-or-nothing.</p>
<br/>
<form action="sharing.php" method="post">
    <fieldset>
        <div class="form-group">
            <label for="username">Provide the username of the user you would like to share your job data with:</label>
            <input autofocus id="username" name="username" placeholder="Username" type="text" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Share!</button>
        </div>
    </fieldset>
</form>
