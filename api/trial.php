<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trial</title>
</head>
<body>
  <h5>Test single input APIS</h5>
  <form action="http://localhost/projects/fintech/api/users.php?action=FORGET_PSWD" method="post">
    <input type="text" name="phone">
    <button type="submit">Submit</button>
  </form>
  <h5>Register</h5>
  <form action="http://localhost/projects/fintech/api/users.php?action=RELOGIN_USER" method="post">
    <input type="text" name="phone"> <br>
    <input type="text" name="code"> <br>
    <input type="text" name="days"> <br>
    <input type="text" name="g1_phone"> <br>
    <input type="text" name="g2"> <br>
    <input type="text" name="g2_phone"> <br>
    <input type="text" name="status"> <br>
    <input type="text" name="due_date"> <br>
    <button type="submit">Submit</button>
  </form>
</body>
</html>



