function analyzeNumbers(num1, num2, num3) {
    var smallest = num1;
    var largest = num1;

    if (num2 < smallest) {
        smallest = num2;
    }
    if (num2 > largest) {
        largest = num2;
    }
    if (num3 < smallest) {
        smallest = num3;
    }
    if (num3 > largest) {
        largest = num3;
    }

    console.log("Smallest:", smallest);
    console.log("Largest:", largest);

    function isPrime(num) {
        if (num <= 1) {
            return false;
        }
        for (var i = 2; i < num; i++) {
            if (num % i === 0) {
                return false;
            }
        }
        return true;
    }

    if (isPrime(smallest)) {
        console.log("The smallest number", smallest, "is prime");
    } else {
        console.log("The smallest number", smallest, "is not prime");
    }

    if (isPrime(largest)) {
        console.log("The largest number", largest, "is prime");
    } else {
        console.log("The largest number", largest, "is not prime");
    }
}

// koristenje na funkcija
analyzeNumbers(13, 15, 20);