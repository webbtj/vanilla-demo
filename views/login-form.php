<?php require_once(dirname(__FILE__) . '/common/header.php'); ?>

<article>
  <h1>BYOS Demo App</h1>
  <?php if(isset($error) && $error): ?>
    <span class="error">
      <?php echo $error; ?>
    </span>
  <?php endif; ?>
  <?php if(isset($success) && $success): ?>
    <span class="success">
      <?php echo $success; ?>
    </span>
  <?php endif; ?>
  <form method="post" action="/login">
    <div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" />
    </div>
    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" />
    </div>
    <div>
      <input type="submit" id="submit" value="Login" />
    </div>
  </form>
</article>

<?php require_once(dirname(__FILE__) . '/common/footer.php'); ?>