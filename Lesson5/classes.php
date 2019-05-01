<h1> Lesson 5 - Exercise#1 </h1>
<h2> Create a base class and a derived class </h2>

<?php
    class Traveling
    {
        //Class properties
        public $country;
        public $month;
        public $season;

        //Assigning the values using the constructor
        public function __construct($country, $month, $season){
            $this->country = $country;
            $this->month = $month;
            $this->season = $season;
        }

    //Creating a method
    public function info(){
        return "<hr/>We like to travel in " .$this->season. " season to " .$this->country. " in " .$this->month. ".<br/>";
        }
    }//end of class definition

    //creating a derived class
    class countryInfo extends Traveling {
        //creating additional properties for the Traveling experinces
        public $countryCity;
        public $countryResort;
        public $cost;
        public $numberofGuest;
        public $howLong;        

    //Assigning he values
        public function __construct($countryCity, $countryResort, $tripCost, $numberofGuest, $howLong){
            $this->countryCity = $countryCity;
            $this->countryResort = $countryResort;
            $this->tripCost = $tripCost;
            $this->numberofGuest = $numberofGuest;
            $this->howLong = $howLong;
            }
    //Creating a method that prints derived and base properties
        public function info(){
            return "The city we like to stay is "
            . $this->countryCity .". <br><br> The top resort in this city is " . $this->countryResort . " and usally the 
            cost will depends on what you looking for. If you have a group of " . $this->numberofGuest . " it will be " . $this->tripCost ."<hr/>";
            
        }
    }//end of derived class definition
    
    $traveling = new Traveling('Costa Rica','March', 'Winter');

    echo $traveling->info();

    $countryInfo = new countryInfo('San Jose', 'Grano de Oro', '$1,3336.00', 7, 'three');

    echo $countryInfo->info();

?>