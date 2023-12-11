DROP DATABASE IF EXISTS student_passwords;

CREATE DATABASE student_passwords;

DROP USER IF EXISTS 'passwords_user'@'localhost';

CREATE USER 'passwords_user'@'localhost' IDENTIFIED BY 'batmanwholaughs23!';
GRANT ALL ON student_passwords.* TO 'passwords_user'@'localhost';

USE student_passwords;


CREATE TABLE websites (
    site_name VARCHAR(255) NOT NULL,
    site_URL VARCHAR(255) NOT NULL,
    PRIMARY KEY (site_URL)
);

CREATE TABLE users (
    site_URL VARCHAR(255) NOT NULL,
    f_name VARCHAR(100) NOT NULL,
    l_name VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    email_address VARCHAR(100) NOT NULL,
    pwd VARCHAR(100) NOT NULL,
    comment TEXT,
    PRIMARY KEY (site_URL, username, pwd)
);

INSERT INTO websites 
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
        ('Nike', 'https://www.nike.com');

INSERT INTO users 
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
        ('https://www.nike.com', 'Gwen', 'Stacy', 'msstacy', 'spicystacy@gmail.com', 'captainstacy', 'I need new jordans');

