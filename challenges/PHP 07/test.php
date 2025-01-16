<?php

include 'index.php';

$furniture = new Furniture(100, 200, 50);
$furniture->setIsForSeating(true);
$furniture->setIsForSleeping(false);
echo "Furniture area: " . $furniture->area() . "\n";
echo "Furniture volume: " . $furniture->volume() . "\n";
echo "Is for seating: " . ($furniture->getIsForSeating() ? "Yes" : "No") . "\n";
echo "Is for sleeping: " . ($furniture->getIsForSleeping() ? "Yes" : "No") . "\n\n";

         
$sofa = new Sofa(150, 200, 80);
$sofa->setIsForSeating(true);
$sofa->setIsForSleeping(false);
$sofa->setSeats(3);
$sofa->setArmrests(2);
$sofa->setLengthOpened(220);


echo "Sofa area: " . $sofa->area() . "\n";
echo "Sofa volume: " . $sofa->volume() . "\n";
echo "Sofa area_opened: " . $sofa->area_opened() . "\n";


echo "Sofa:\n";
$sofa->print();
$sofa->sneakpeek();
$sofa->fullinfo();

echo "\nBench:\n";
$bench = new Bench(120, 40, 45);
$bench->setIsForSeating(true);
$bench->setIsForSleeping(false);
$bench->print();
$bench->sneakpeek();
$bench->fullinfo();

echo "\nChair:\n";
$chair = new Chair(50, 50, 90);
$chair->setIsForSeating(true);
$chair->setIsForSleeping(false);
$chair->print();
$chair->sneakpeek();
$chair->fullinfo();

?>