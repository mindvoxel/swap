<?php
    /*The data from this class will be placed in an sql database. The
    data will be generated from a form on the front-end. It represents
    a user's swap profile. This class can be used to format the 
    data on initialization, ensure that the data fits certain criteria, 
    and do null checks*/

    class Profile{
        private $username; //can probably format this with regex, but
                           //that can also be done on the front end
        private $password; //same
        private $inventory; //should be a list of 'items'
                            //the size of this item will be the 
                            //number of items in a user's inventory

        //Dont allow the feilds to be null. Profile should always have atleast
        //a username, a password, and an inventory
        public function __construct(string $username, string $password,
        array $inventory){
            $this->username = $username;
            $this->password = $password;
            $this->inventory = $inventory;
        }

        //getter
        public function get_username() :string{
            return $this->username;
        }

        //getter
        public function get_password() :string{
            return $this->password;
        }

        //getter
        public function get_inventory() :array{
            return $this->inventory;
        }

        //to string function
        public function __toString() :string{
            return "username: " . $this->username . " password: " . $this->password .
            " inventory: " . $this->inventory;
        }
        //some very very crude functions to add and access profiles in the database
        public function add_profile_to_db() {
            $profile = $this;
            $username = $profile->username;
            $password = $profile->password;

            //encrypting password here
            $password_encrypted = password_hash($password, PASSWORD_BCRYPT);

            $servername = "localhost";
            $dbusername = "swapadmin";
            $password = "password";
            $dbname = "swapbase";
            $table = "profiles";
            // Create connection
            $conn = new mysqli($servername, $dbusername, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($profile->find_profile_on_db($username) == null) {
                // sql to add or create table
                if ($conn->query("DESCRIBE `profiles`")) {
                    //table exists^^
                    $sqlQuery = sprintf("insert into $table (username,password) values ('%s','%s')",
                        $username, $password_encrypted);
                    $result = mysqli_query($conn, $sqlQuery);
                    if ($result) {
                        //"<h3>The entry has been added to the database</h3>";
                    } else {
                       echo "Adding profile failed." . mysqli_error($conn);
                    }
                } else {
                    //create table if it does not exist
                    $sql = "CREATE TABLE profiles (
                    username VARCHAR(50) NOT NULL, 
                    password VARCHAR(75) NOT NULL)";

                    $sql2 = "CREATE TABLE items (
                    name VARCHAR(100) NOT NULL, 
                    user_key VARCHAR(75) NOT NULL,
                    description VARCHAR(1000),
                    estimated_value VARCHAR(10))";

                    //need to link the inventory table to the profile table with a key, not quite sure how to do that

                    if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
                        "Table profiles table created successfully";
                        /* application to be added to table */
                        $sqlQuery = sprintf("insert into $table (username,password) values ('%s', '%s')",
                            $username, $password_encrypted);
                        $result = mysqli_query($conn, $sqlQuery);
                        if ($result) {
                            //"<h3>The entry has been added to the database</h3>";
                        } else {
                            echo "Inserting records failed." . mysqli_error($conn);
                        }
                    } else {
                        echo "Error creating table: " . $conn->error;
                    }
                }
                $conn->close();
            } else {
                //update database rather than add something new
                //this allows people to update their password and stuff but is problematic for obvious reasons
                //we should change it
                $sqlQuery = sprintf("update $table set username = '%s' , password = '%s' where username = '%s'",
                    $username, $password_encrypted, $username);
                $result = mysqli_query($conn, $sqlQuery);
                if ($result) {
                    #"<h3>The entry has been updated in the database</h3>";
                } else {
                    "Updating records failed." . mysqli_error($conn);
                }
            }

        }

        public function find_profile_on_db($username) {
            $servername = "localhost";
            $dbusername = "swapadmin";
            $password = "password";
            $dbname = "swapbase";
            $table = "profiles";
            // Create connection
            $conn = new mysqli($servername, $dbusername, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                return null;
            }

            $sqlQuery = sprintf("select * from %s where username = '%s'", $table, $username);
            $result = mysqli_query($conn, $sqlQuery);
            $ret = new Profile("", "", []);
            if ($result) {
                $numberOfRows = mysqli_num_rows($result);
                if ($numberOfRows > 0) {
                    // output data of each row
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $ret->username = $row["username"];
                    $ret->password = $row["password"];

                    //need to do inventory stuff here
                } else {
                    return null;
                }
                $conn->close();
                return $ret;
            }
            return null;
        }
    }
?>