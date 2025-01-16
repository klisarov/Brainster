<?php

require_once 'index.php';

class Potato extends Product {
    public function __construct() {
        parent::__construct('Potato', 240, false);
    }
}

?>