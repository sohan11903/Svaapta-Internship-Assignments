<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="GET">
        Enter String: <input type="text" name="name" value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>">
        <input type="submit">
    </form>

    <?php
    $myStr = trim($_GET["name"]);
    $count = 0;
    $digit = 0;
    $white = 0;
    for ($i = 0; $i < strlen($myStr); $i++) {
        $ch = strtolower($myStr[$i]);
        if ($ch == 'a' || $ch == 'e' || $ch == 'i' || $ch == 'o' || $ch == 'u') {
            $count += 1;
        }
        if (is_numeric($myStr[$i])) {
            $digit++;
        }
        if ($myStr[$i] == ' ') {
            $white++;
        }
    }
    echo "<h1>Problem 1</h1><br>";
    echo "Number of character in string :- " . strlen($myStr) - $white . "<br>";
    echo "Number of Vowels :- " . $count . "<br>";
    echo "Number of Consonants :- " . (strlen($myStr) - $digit - $white) - $count . "<br>";
    echo "Number of Digits :- " . $digit . "<br>";
    echo "Number of whitespace :- " . $white . "<br>";
    echo "number of occurrences of ‘a’ :-" . substr_count($myStr, 'a');
    echo "<h1>Problem 2</h1><br>";
    $primeArr = [];
    for ($i = 2; $i < 100; $i++) {
        $flag = true;
        $currNum = $i;
        for ($j = 2; $j < $currNum; $j++) {
            if ($currNum % $j == 0) {
                $flag=false;
                break;
            }
        }
        if ($flag==true){
            array_push($primeArr,$currNum);
        }
    }

    for ($i = 0; $i < count($primeArr); $i++) {
        echo $primeArr[$i] . " ";
    }
    echo "<h1>Problem 3</h1><br>";
    for ($year = 2000; $year <= 3000; $year++) {
        if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) {
            echo $year . " ";
        }
    }
    echo "<br>";
    echo "<h1>Problem 4</h1><br>";
    $rand1 = rand(1, 10);
    $larArr = [];
    for ($i = 0; $i < $rand1; $i++) {
        array_push($larArr, rand(1, 100));
    }
    echo max($larArr);
    echo "<br>";
    echo "<h1>Problem 4</h1><br>";
    $rand2 = rand(1, 10);
    $larArr2 = [];
    for ($i = 0; $i < $rand2; $i++) {
        array_push($larArr2, rand(1, 100));
    }
    print_r($larArr2);
    echo "<br>";
    for ($i = 0; $i < count($larArr2) - 1; $i++) {
        $min = $larArr2[$i];
        $idx = $i;
        for ($j = $i + 1; $j < count($larArr2); $j++) {
            if ($min >= $larArr2[$j]) {
                $min = $larArr2[$j];
                $idx = $j;
            }
        }
        if ($idx != $i) {
            $temp = $larArr2[$i];
            $larArr2[$i] = $larArr2[$idx];
            $larArr2[$idx] = $temp;
        }
    }
    for ($i = 0; $i < count($larArr2); $i++) {
        echo $larArr2[$i] . " ";
    }
    ?>


</body>

</html>