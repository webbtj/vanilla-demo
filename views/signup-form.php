<?php require_once(dirname(__FILE__) . '/common/header.php'); ?>

<article>
  <h1>BYOS Demo App</h1>
  <p>
    Please sign up to access the Dashboard.
    You can also create Bearer tokens to access the API.
  </p>
  <?php if(isset($error) && $error): ?>
    <span class="error">
      <?php echo $error; ?>
    </span>
  <?php endif; ?>
  <form method="post" action="/signup">
    <div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" />
    </div>
    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" />
    </div>
    <div>
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" />
    </div>
    <div>
      <input type="submit" id="submit" value="Login" />
    </div>
  </form>
</article>

<?php require_once(dirname(__FILE__) . '/common/footer.php'); ?>