<?php

require_once 'index.php';

class Orange extends Product {
    public function __construct() {
        parent::__construct('Orange', 35, true);
    }
}

?>