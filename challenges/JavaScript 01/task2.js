function checkDivisible(n) {
    for (var i = 10; i <= 100; i++) {
        if (i % 2 === 0 && i % n === 0) {
            console.log(i);
        }
    }
}

// koristenje na funkcija
checkDivisible(3);