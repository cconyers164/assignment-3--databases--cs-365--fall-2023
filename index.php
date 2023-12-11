<?php
require "includes/helpers.php";
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Assignment #3</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200&family=Roboto:wght@100&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<form method="POST"> 
    <input type="submit" name="reset" value="Reset">
</form>
  <?php
    if(array_key_exists('reset',$_POST)) {
      resetDatabase();
    }
  ?>
  <header>
    <h1>Student Password Manager</h1>
  </header>
  <main>
  <section> 
    <h2>Create a User</h2>
    <hr>
    <p>Enter your information here:</p>
    <form action="/assignment-3--databases--cs-365--fall-2023/index.php" method="POST">
        <label for="table_1">Table 1:</label><br>
        <input type="text" id="table_1" name="table_1"><br>
        <label for="site_URL">Website URL:</label><br>
        <input type="text" id="site_URL" name="site_URL"><br>
        <label for="site_name">Website Name:</label><br>
        <input type="text" id="site_name" name="site_name"><br>
        <label for="table_2">Table 2:</label><br>
        <input type="text" id="table_2" name="table_2"><br>
        <label for="f_name">First Name:</label><br>
        <input type="text" id="f_name" name="f_name"><br>
        <label for="l_name">Last Name:</label><br>
        <input type="text" id="l_name" name="l_name"><br>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="email_address">Email:</label><br>
        <input type="text" id="email_address" name="email_address"><br>
        <label for="pwd">Password:</label><br>
        <input type="text" id="pwd" name="pwd"><br>
        <label for="comment">Comment:</label><br>
        <input type="text" id="comment" name="comment"><br>
        <input type="submit" name="submit4" value="Submit">
      </form>
      <?php
      if(isset($_POST["submit4"])) {
        createNewEntry($_POST["table_1"], $_POST["site_URL"], $_POST["site_name"], $_POST["table_2"], $_POST["site_URL"], $_POST["f_name"], $_POST["l_name"], $_POST["username"], $_POST["email_address"], $_POST["pwd"], $_POST["comment"]);
        echo "Entry Created.";
      }
      ?>
    </section>
    <section>
      <h2>Check to see if a value already exists in a table</h2>
      <hr>
      <form action="/assignment-3--databases--cs-365--fall-2023/index.php" method="POST">
        <label for="value">Value:</label><br>
        <input type="text" id="value" name="value"><br>
        <label for="attribute">Attribute:</label><br>
        <input type="text" id="attribute" name="attribute"><br>
        <label for="table">Table:</label><br>
        <input type="text" id="table" name="table"><br>
        <input type="submit" name="submit" value="Submit">
      </form>
        <?php
        if(isset($_POST["submit"]))
            if(valueExistsInAttribute($_POST["value"], $_POST["attribute"], $_POST["table"])) {
                echo "Yes, this is inside the database";
            } else {
                echo "No, this is not inside the database";
            }
        ?>
      </p>
    </section>
    <section>
      <h2>Fetch all Attribute Values in a Table</h2>
      <hr>
      <form action="/assignment-3--databases--cs-365--fall-2023/index.php" method="POST">
        <label for="attribute">Attribute:</label><br>
        <input type="text" id="attribute" name="attribute"><br>
        <label for="table">Table:</label><br>
        <input type="text" id="table" name="table"><br>
        <input type="submit" name="submit1" value="Submit">
      </form>
      <ul>
        <?php
        if(isset($_POST["submit1"])) 
            printAttributesFromTable($_POST["attribute"], $_POST["table"]); 
          ?>
      </ul>
    </section>
    <section>
      <h2>Update a User</h2>
      <hr>
      <form action="/assignment-3--databases--cs-365--fall-2023/index.php" method="POST">
        <label for="table">Table:</label><br>
        <input type="text" id="table" name="table"><br>
        <label for="current_attribute">Current Attribute:</label><br>
        <input type="text" id="current_attribute" name="current_attribute"><br>
        <label for="new_attribute">New Attribute:</label><br>
        <input type="text" id="new_attribute" name="new_attribute"><br>
        <label for="query_attribute">Query Attribute:</label><br>
        <input type="text" id="query_attribute" name="query_attribute"><br>
        <label for="pattern">Pattern:</label><br>
        <input type="text" id="pattern" name="pattern"><br>
        <input type="submit" name="submit2" value="Submit">
      </form>
        <?php
        if(isset($_POST["submit2"])) {
            updateAttribute($_POST["table"], $_POST["current_attribute"], $_POST["new_attribute"], $_POST["query_attribute"], $_POST["pattern"]);
            echo "Updated.";
        }
        ?>
      </p>
    </section>
    <section>
    <h2>Delete a User</h2>
      <hr>
      <form action="/assignment-3--databases--cs-365--fall-2023/index.php" method="POST">
        <label for="table">Table:</label><br>
        <input type="text" id="table" name="table"><br>
        <label for="attribute">Attribute:</label><br>
        <input type="text" id="attribute" name="attribute"><br>
        <label for="query">Query:</label><br>
        <input type="text" id="query" name="query"><br>
        <input type="submit" name="submit3" value="Submit">
      </form>
      <?php
      if(isset($_POST["submit3"])) {
        delete($_POST["table"], $_POST["attribute"], $_POST["query"]);
        echo "Deleted.";
      }
      ?>
    </section>
  </main>
</body>
</html>