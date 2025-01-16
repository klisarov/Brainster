<?php

require_once 'index.php';

class Pepper extends Product {
    public function __construct() {
        parent::__construct('Pepper', 330, true);
    }
}

?>