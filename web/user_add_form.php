<?php

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (isset($_POST['name']) && isset($_POST['pass'])) {

  include_once "db_connection.php";

  $username = $_POST['name'];
  $password = $_POST['pass'];

  $conn = get_db_connection();
  $conn->query("INSERT INTO user (username, password) VALUES ('$username', '$password')");
  $conn->close();
  

  $output=null;
  $retval=null;
  exec('curl -I -X PURGE http://varnish', $output, $retval);
  echo "Returned with status $retval and output:\n";
  echo '<pre>'.print_r($output, TRUE).'</pre>';
}

include_once "page-top.php";

?>

<form action="user_add_form.php" method="post">
  <p>Username: <input type="text" name="name" /></p>
  <p>Password: <input type="text" name="pass" /></p>
  <p><input type="submit" /></p>
</form>

<?php include_once "page-bottom.php"; ?>
