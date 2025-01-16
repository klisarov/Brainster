<?php
// Креирање на променливи и проверка
$name = "Kathrin";
if ($name == "Kathrin") {
    echo "Hello Kathrin\n";
} else {
    echo "Nice name\n";
}

// Променлива за рејтинг
$rating = 5;  
if ($rating >= 1 && $rating <= 10) {
    echo "Thank you for rating\n";
} else {
    echo "Invalid rating, only numbers between 1 and 10\n";
}

// Date функција за препознавање на дел од времето
$hour = date("H");
if ($hour < 12) {
    echo "Good morning Kathrin\n";
} elseif ($hour >= 12 && $hour < 19) {
    echo "Good afternoon Kathrin\n";
} else {
    echo "Good evening Kathrin\n";
}

// Додатна проверка за дали гласачот има гласано
$rated = false;  
if ($rating >= 1 && $rating <= 10) {
    if ($rated) {
        echo "You already voted\n";
    } else {
        echo "Thanks for voting\n";
    }
}

// Array 
$voters = [
    "Marija" => "false,5",
    "Nikola" => "true,8",
    "Angela" => "false,90",
    "Dzon" => "true,2",
    "Elena" => "false,10",
    "Slagana" => "true,4",
    "Filip" => "false,3",
    "Marko" => "false,8",
    "Viktor" => "true,1",
    "Angel" => "false,7"
];

// Output на порака кон гласачите
foreach ($voters as $voterName => $data) {
    list($voted, $voteRating) = explode(",", $data);
    $voted = $voted === "true" ? true : false;  
    echo $timeDay . " " . $voterName . ",\n";  

    if (is_numeric($voteRating) && $voteRating >= 1 && $voteRating <= 10) {
        if ($voted) {
            echo "You already voted with a $voteRating.\n";
        } else {
            echo "Thanks for voting with a $voteRating.\n";
        }
    } else {
        echo "Invalid rating, only numbers between 1 and 10.\n";
    }
}
?>
