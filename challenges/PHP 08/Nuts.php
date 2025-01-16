<?php

require_once 'index.php';

class Nuts extends Product {
    public function __construct() {
        parent::__construct('Nuts', 850, true);
    }
}

?>