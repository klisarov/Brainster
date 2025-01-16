<?php
// проверка за римски број
function checkNumType($number) {
    $romanChar = 'IVXLCDM';
    $isRoman = true;
    for ($i = 0; $i < strlen($number); $i++) {
        if (strpos($romanChar, strtoupper($number[$i])) === false) { 
            $isRoman = false;
            break;
        }
    }
    if ($isRoman) {
        return "Roman";
    }
    // проверка за бинарен број...
    $isBinary = true;
    for ($i = 0; $i < strlen($number); $i++) {
        if ($number[$i] !== '0' && $number[$i] !== '1') {
            $isBinary = false;
            break;
        }
    }
    if ($isBinary) {
        return "Binary";
    }
    // проверка за децимален број
    if ($number[0] === '+' || $number[0] === '-') {
        // проверка за error case
        if (strlen($number) > 2 && $number[1] === '0') {
            return "Error! Бројот треба да започнува со нула.";
        }
        
        // проверка дали после знакот имаме броеви
        for ($i = 1; $i < strlen($number); $i++) {
            if ($number[$i] < '0' || $number[$i] > '9') {
                return "Погрешен input";
            }
        }
        return "Decimal";
    }
    
    // ако немаме знак, правиме проверка дали е децимален број без знак
    $isDecimal = true;
    for ($i = 0; $i < strlen($number); $i++) {
        if ($number[$i] < '0' || $number[$i] > '9') {
            $isDecimal = false;
            break;
        }
    }
    if ($isDecimal) {
        return "Decimal";
    }
    return "Погрешен input";
}

// низа
$numbers = array(
    "XIV",      
    "01101",    
    "+42",      
    "-7",       
    "MCMLIV",   
    "100",      
    "3135",     
    "+0123",    
    "V",        
    "-256"      
);

// итерација и output на број, вид на број
for ($i = 0; $i < count($numbers); $i++) {
    $numType = checkNumType($numbers[$i]);
    echo "Број " . ($i + 1) . ": " . $numbers[$i] . " - Вид: " . $numType . "\n";
}
?>