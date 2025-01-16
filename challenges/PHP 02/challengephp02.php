<?php
// 1 - konverzija na decimalen vo binaren broj
function decimalBinary($decimal) {
    if ($decimal == 0) {
        return '0'; // ako vlezniot broj e 0, vraka niza 0.
    }

    $binary = '';
    // sprotivno koristime while ciklus za da go pretvorime brojot vo binaren
    while ($decimal > 0) {
        $binary = ($decimal % 2) . $binary;
        $decimal = intdiv($decimal, 2); // intdiv gi deli $decimal i brojot 2, i rezultatot go smestuva vo promenliva.
    }
    return $binary;
}

// 2 - konverzija na decimalen broj vo rimski broj
function decimalRoman($number) {
    if ($number > 3999) {
        return "Error!! Number is bigger than 3999."; 
    }

    $sym = [
        'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
        'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
        'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
    ]; 

    $roman = '';
    foreach ($sym as $romanSym => $value) {
        while ($number >= $value) {
            $roman .= $romanSym;
            $number -= $value;
        }
    }
    return $roman;
}

// 3- binaren broj vo decimalen
function binaryDecimal($binary){
    $decimal = bindec($binary); // користам вградена функција во PHP за конверзија на бинарен во децимален број
    return $decimal; 

// 4- konverzija na rimski vo decimalen broj
function romanDecimal($roman){
    $romanSym = [
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000
    ];

    $decimal = 0;
    $lastValue = 0;

    // Iteracija za sekoj char
    for($i = strlen($roman) - 1; $i >= 0; $i--){
        $currentValue = $romanSym[$roman[$i]];
        // se dodava ili odzema vrednost zavisno od predhodnata vrednost
        if($currentValue < $lastValue) {
            $decimal -= $currentValue;
        } else {
            $decimal += $currentValue;
        }

        $lastValue = $currentValue;
    }

    return $decimal;

}

?>

