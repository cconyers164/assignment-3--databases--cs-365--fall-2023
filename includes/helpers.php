<?php

function valueExistsInAttribute($value, $attribute, $table) {
    try {
        include_once "config.php";

        $db = new PDO(
            "mysql:host=" . DBHOST . "; dbname=" . DBNAME . ";charset=utf8",
            DBUSER,
            DBPASS
        );

        $statement = $db -> prepare("SELECT $attribute FROM $table");
        $statement -> execute();

        $found = false;

        while (($row = $statement -> fetch())) {
            if ($value == $row[$attribute]) {
                $found = true;
                break;
            }
        }

        $statement = null;

        return $found;
    }
    catch(PDOException $error) {
        echo "<p class='highlight'>The function " .
            "<code>valueExistsInAttribute</code> has resulted in the " .
            "following error:</p>" .
            "<pre>$error</pre>" .
            "<p class='highlight'>Exit</p>";

        exit;
    }
}


function getValue($value, $table, $query, $pattern) {
    try {
        include_once "config.php";

        $db = new PDO("mysql:host=".DBHOST."; dbname=".DBNAME, DBUSER, DBPASS);

        $statement = $db ->
            prepare("SELECT $value FROM $table WHERE $query = :q");

        $statement -> execute(array('q' => $pattern));

        $row = $statement -> fetch();

        $statement = null;

        if ($row === false) {
            $result = false;
        } else {
            $result = $row[$value];
        }

        return $result;
    }
    catch(PDOException $error) {
        echo "<p class='highlight'>The function <code>getValue</code> has " .
            "resulted in the following error:</p>" .
            "<pre>$error</pre>" .
            "<p class='highlight'>Exit</p>";

        exit;
    }
}


function updateAttribute($table, $current_attribute, $new_attribute, $query_attribute, $pattern) {
    try {
        include_once "config.php";

        $db = new PDO(
            "mysql:host=".DBHOST."; dbname=".DBNAME,
            DBUSER,
            DBPASS
        );

        $statement = $db -> prepare(
            "UPDATE $table " .
            "SET $current_attribute = :new_attribute " .
            "WHERE $query_attribute = :pattern"
        );

        $statement -> execute(
            array('new_attribute' => $new_attribute, 'pattern' => $pattern)
        );

        $statement = null;
    }
    catch(PDOException $error) {
        echo "<p class='highlight'>The function <code>updateAttribute</code> " .
            "has resulted in the following error:</p>" .
            "<pre>$error</pre>" .
            "<p class='highlight'>Exit</p>";

        exit;
    }
}


function delete($table, $attribute, $query) {
    try {
        include_once "config.php";

        $db = new PDO("mysql:host=".DBHOST."; dbname=".DBNAME,
            DBUSER,
            DBPASS);

        $statement = $db ->
            prepare("DELETE FROM $table WHERE $attribute = :query");
        $statement -> execute(array('query' => $query));
        $statement = null;
    } catch(PDOException $error) {
        echo "<p class='highlight'>The function <code>delete</code> " .
            "has resulted in the following error:</p>" .
            "<pre>$error</pre>" .
            "<p class='highlight'>Exit</p>";

        exit;
    }
}


function printAttributesFromTable($attribute, $table) {
    try {
        include_once "config.php";

        $db = new PDO(
            "mysql:host=" . DBHOST . ";dbname=" . DBNAME,
            DBUSER,
            DBPASS
        );

        $statement = $db -> prepare("SELECT '$attribute' FROM $table");
        $statement -> execute();

        while($row = $statement -> fetch(PDO::FETCH_NUM)) {
            echo "<li>$row[0]</li>\n";
        }

        $statement = null;

    } catch(PDOException $error) {
        echo "<p class='highlight'>The function " .
            "<code>printAttributesFromTable</code> has resulted in the " .
            "following error:</p>" .
            "<pre>$error</pre>" .
            "<p class='highlight'>Exit</p>";

        exit;
    }
}

function createNewEntry($table_1, $site_URL, $site_name, $table_2, $f_name, $l_name, $username, $email_address, $pwd, $comment) {
    try {
        include_once "config.php";

        $db = new PDO(
            "mysql:host=" . DBHOST . ";dbname=" . DBNAME,
            DBUSER,
            DBPASS
        );

        $statement = $db -> prepare("INSERT INTO $table_1 VALUES ('$site_URL', '$site_name')");
        $statement -> execute();
        $statement = null;

        $statement = $db -> prepare("INSERT INTO $table_2 VALUES ('$site_URL', '$f_name', '$l_name', '$username', '$email_address', '$pwd', '$comment')");
        $statement -> execute();
        $statement = null;

        

    } catch(PDOException $error) {
        echo "<p class='highlight'>The function " .
            "<code>printAttributesFromTable</code> has resulted in the " .
            "following error:</p>" .
            "<pre>$error</pre>" .
            "<p class='highlight'>Exit</p>";

        exit;
    }
}

function resetDatabase() {
    include_once "config.php";

    $db = new PDO(
        "mysql:host=" . DBHOST . ";dbname=" . DBNAME,
        DBUSER,
        DBPASS
    );
    
    $statement = $db -> prepare("DROP TABLE IF EXISTS websites");
    $statement -> execute();
    $statement = null;

    $statement = $db -> prepare("DROP TABLE IF EXISTS users");
    $statement -> execute();
    $statement = null;

    $statement = $db -> prepare("CREATE TABLE websites (
        site_name VARCHAR(255) NOT NULL,
        site_URL VARCHAR(255) NOT NULL,
        PRIMARY KEY (site_URL))");
    $statement -> execute();
    $statement = null;

    $statement = $db -> prepare("CREATE TABLE users (
        site_URL VARCHAR(255) NOT NULL,
        f_name VARCHAR(100) NOT NULL,
        l_name VARCHAR(100) NOT NULL,
        username VARCHAR(100) NOT NULL,
        email_address VARCHAR(100) NOT NULL,
        pwd VARCHAR(100) NOT NULL,
        PRIMARY KEY (site_URL, username, pwd))");
    $statement -> execute();
    $statement = null;

    $statement = $db -> prepare("INSERT INTO websites 
        VALUES
            ('Amazon', 'https://www.amazon.com'),
            ('Ebay', 'https://www.ebay.com'),
            ('Facebook', 'https://www.facebook.com/'),
            ('Linkedin', 'https://www.linkedin.com'),
            ('Target', 'https://www.target.com'),
            ('Walmart', 'https://www.walmart.com'),
            ('Taco Bell', 'https://www.tacobell.com'),
            ('Best Buy', 'https://www.bestbuy.com'),
            ('Microcenter', 'https://www.microcenter.com'),
            ('Nike', 'https://www.nike.com');");
    $statement -> execute();
    $statement = null;

    $statement = $db -> prepare("INSERT INTO users 
        VALUES
            ('https://www.amazon.com', 'Miles', 'Morales', 'ULTSpiderman', 'milesmorales@gmail.com', 'myuncleistheprowler23!', 'This is my amazon account'),
            ('https://www.ebay.com', 'Peter', 'Parker', 'AMZSpiderman', 'peter11@outlook.com', 'Normanstinks98$', 'This is my ebay account'),
            ('https://www.facebook.com', 'Eddie', 'Brock', 'WeAreVenom64&', 'ebrock@gmail.com', 'IhateSpidey11!', 'I hate facebook'),
            ('https://www.linkedin.com', 'Otto', 'Octavius', 'DocOck12', 'octavius@outlook.com', 'IamSuperiorhaha12', 'Someone hire me please'),
            ('https://www.target.com', 'Ben', 'Reily', 'Chasm66', 'Beyondcorp@gmail.com', 'clonesagasucks11', 'Black Friday sales are coming up'),
            ('https://www.walmart.com', 'Cletus', 'Cassadiy', 'Carnage009', 'carnage@gmail.com', 'maximumcarnage###', 'Walmart got good sales too'),
            ('https://www.tacobell.com', 'Aaron', 'Davis', 'prowler678', 'prowler@gmail.com', 'moneyBAGheist22', 'Good food'),
            ('https://www.bestbuy.com', 'Mac', 'Gargan', 'Electro24', 'electro@outlook.com', 'EnterElectro!!', 'Christmas deals will be good'),    
            ('https://www.microcenter.com', 'Felica', 'Hardy', 'BlackCat88', 'fhardy@gmail.com', 'catburglar23!', 'Need a new computer'),
            ('https://www.nike.com', 'Gwen', 'Stacy', 'msstacy', 'spicystacy@gmail.com', 'captainstacy', 'I need new jordans');");
    $statement -> execute();
    $statement = null;
}
?>