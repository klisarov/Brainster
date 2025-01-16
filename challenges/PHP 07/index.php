<?php

class Furniture {
    protected $width;
    protected $length;
    protected $height;
    private $is_for_seating;
    private $is_for_sleeping;

    public function __construct($width, $length, $height) {
        $this->width = $width;
        $this->length = $length;
        $this->height = $height;
    }

    public function setIsForSeating($value) {
        $this->is_for_seating = $value;
    }

    public function getIsForSeating() {
        return $this->is_for_seating;
    }

    public function setIsForSleeping($value) {
        $this->is_for_sleeping = $value;
    }

    public function getIsForSleeping() {
        return $this->is_for_sleeping;
    }

    public function area() {
        return $this->width * $this->length;
    }

    public function volume() {
        return $this->area() * $this->height;
    }
}

class Sofa extends Furniture implements Printable {
    private $seats;
    private $armrests;
    private $length_opened;

    public function __construct($width, $length, $height) {
        parent::__construct($width, $length, $height);
    }

    public function setSeats($value) {
        $this->seats = $value;
    }

    public function getSeats() {
        return $this->seats;
    }

    public function setArmrests($value) {
        $this->armrests = $value;
    }

    public function getArmrests() {
        return $this->armrests;
    }

    public function setLengthOpened($value) {
        $this->length_opened = $value;
    }

    public function getLengthOpened() {
        return $this->length_opened;
    }

    public function area_opened() {
        if ($this->getIsForSleeping()) {
            return $this->width * $this->length_opened;
        } else {
            return "This sofa is for sitting only, it has {$this->armrests} armrests and {$this->seats} seats";
        }
    }

    public function print() {
        $sleepStatus = $this->getIsForSleeping() ? "sleeping" : "sitting only";
        echo get_class($this) . ", {$sleepStatus}, " . $this->area() . "cm2\n";
    }

    public function sneakpeek() {
        echo get_class($this) . "\n";
    }

    public function fullinfo() {
        $sleepStatus = $this->getIsForSleeping() ? "sleeping" : "sitting only";
        echo get_class($this) . ", {$sleepStatus}, " . $this->area() . "cm2, width: {$this->width}cm, length: {$this->length}cm, height: {$this->height}cm\n";
    }
}

class Bench extends Sofa implements Printable {
    public function __construct($width, $length, $height) {
        parent::__construct($width, $length, $height);
    }

}

class Chair extends Furniture implements Printable {
    public function __construct($width, $length, $height) {
        parent::__construct($width, $length, $height);
    }

    public function print() {
        $sleepStatus = $this->getIsForSleeping() ? "sleeping" : "sitting only";
        echo get_class($this) . ", {$sleepStatus}, " . $this->area() . "cm2\n";
    }

    public function sneakpeek() {
        echo get_class($this) . "\n";
    }

    public function fullinfo() {
        $sleepStatus = $this->getIsForSleeping() ? "sleeping" : "sitting only";
        echo get_class($this) . ", {$sleepStatus}, " . $this->area() . "cm2, width: {$this->width}cm, length: {$this->length}cm, height: {$this->height}cm\n";
    }
}

interface Printable {
    public function print();
    public function sneakpeek();
    public function fullinfo();
}


?>