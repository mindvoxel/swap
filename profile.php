<?php
    /*The data from this class will be placed in an sql database. The
    data will be generated from a form on the front-end. It represents
    a user's swap profile. This class can be used to format the 
    data on initialialization, ensure that the data fits certain criteria, 
    and do null checks*/

    class Profile{
        private $username; //can probably format this with regex, but
                           //that can also be done on the front end
        private $password; //same
        private $inventory; //should be a list of 'items'

        //Dont allow the feilds to be null. Rather provide default values.
        public function __constructor(){

        }

        //getter
        public function get_username() :string{
            return $this->password;
        }

        //to string function
        public function __toString() :string{
            return "username: " . $this->username . " password: " . $this->password .
            " inventory: " . $this->inventory;
        }

    }
?>