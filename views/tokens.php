<?php require_once(dirname(__FILE__) . '/common/header.php'); ?>

<article>
  <h1>BYOS Demo App</h1>
  <h3>Your Bearer Tokens</h3>
  <p>
    A Bearer Token is required to access the API at <code>/api/user</code>.
    Bearer Tokens are passed as an Authorization header;
    Example: <code>Authorization: Bearer [your-token]</code>
  </p>
  <div>
    <?php foreach ($tokens as $token): ?>
      <div>
        <span class="token">
          <?php echo $token['token']; ?>
        </span>
        <form method="post" action="/tokens/delete" class="delete">
          <input type="hidden" name="id" value="<?php echo $token['id']; ?>" />
          <input type="hidden" name="user_id" value="<?php echo $token['user_id']; ?>" />
          <input type="submit" value="revoke" />
        </form>
      </div>
    <?php endforeach; ?>

    <form method="post" action="/tokens/create">
      <input type="hidden" name="user_id" value="<?php echo user()->id; ?>" />
      <input type="submit" value="Generate Token" />
    </form>
  </div>
</article>

<?php require_once(dirname(__FILE__) . '/common/footer.php'); ?>