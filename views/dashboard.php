<?php require_once(dirname(__FILE__) . '/common/header.php'); ?>

<article>
  <h1>BYOS Demo App</h1>
  <p>
    This dashboard will refresh with a new user every two seconds.
    You will also be prompted to accept notifications which will also 
    push a new notification of user data every two seconds.
  </p>
  <div>
    <img id="user-thumb" />
    <p>
      <strong>Name: </strong>
      <span id="user-name"></span>
    </p>
    <p>
      <strong>Location: </strong>
      <span id="user-location"></span>
    </p>
  </div>
</article>

<?php require_once(dirname(__FILE__) . '/common/footer.php'); ?>