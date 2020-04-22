<html>
  <head>
    <title>BYOS Demo</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
    <script type="text/javascript" src="/assets/js/app.js"></script>
  </head>
  <body>
    <header>
      <ul>
        <?php if(loggedIn()): ?>
          <li><a href="/dashboard">Dashboard</a></li>
          <li><a href="/tokens">Tokens</a></li>
          <li><a href="/logout">Logout</a></li>
        <?php else: ?>
          <li><a href="/login">Login</a></li>
          <li><a href="/signup">Signup</a></li>
        <?php endif; ?>
      </ul>
    </header>