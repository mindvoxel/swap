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
        public function __constructor(string $username, string $password,
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

    }
?>