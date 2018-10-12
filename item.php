<?php

    /*Items will be stored in an array in user's profile. This is the 
    object that users will be trading back and forth.*/
    class Item{

        private $name;
        private $description; //information about the item
        private $value; //estimated value of the item 
                        //potentially have a field for image hyperlink?

        //Would be nice to always have items with a name, description passed in can be
        //empty, I suppose. Value should always be provided (by the user?)
        public function __constructor(string $name, string $description,
        float $value){
            $this->name = $name;
            $this->description = $description;
            $this->value = $value;
        }

        //getter
        public function get_name() :string{
            return $this->name;
        }

        //getter
        public function get_description() :string{
            return $this->description;
        }

        //getter
        public function get_value() :float{
            return $this->float;
        }

        public function __toString(){
            return "name: " . $this->name . " description: " . $this->password .
            " value: " . $this->value;
        }

    }


?>