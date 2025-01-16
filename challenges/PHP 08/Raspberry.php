<?php

require_once 'index.php';

class Raspberry extends Product {
    public function __construct() {
        parent::__construct('Raspberry', 555, false);
    }
}

?>