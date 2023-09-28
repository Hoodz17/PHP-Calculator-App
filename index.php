<?php
include_once "includes/bootstrap5.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER
["PHP_SELF"])  ?>" method="post">
    <input type="number" name="num01"
    placeholder="Number one">
    <select name="operator">
        <option value="add">+</option>
        <option value="subtract">-</option>
        <option value="multiply">*</option>
        <option value="divide">/</option>
    </select>
    <input type="number" name="num02"
           placeholder="Number two">
    <button>Calculate</button>

</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num01 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
    $num02 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
    $operator = htmlspecialchars($_POST["operator"]);

    // Initialize an array to store errors
    $errors = [];

    if (!is_numeric($num01)) {
        $errors[] = "Invalid value for num1.";
    }

    if (!is_numeric($num02)) {
        $errors[] = "Invalid value for num2.";
    }

    $validOperators = ["add", "subtract", "multiply", "divide"];
    if (!in_array($operator, $validOperators)) {
        $errors[] = "Invalid operator selected.";
    }

    if ($operator === "divide" && $num02 == 0) {
        $errors[] = "Division by zero is not allowed.";
    }

    if (empty($errors)) {
        // Perform calculations based on the selected operator
        switch ($operator) {
            case "add":
                $value = $num01 + $num02;
                break;
            case "subtract":
                $value = $num01 - $num02;
                break;
            case "multiply":
                $value = $num01 * $num02;
                break;
            case "divide":
                $value = $num01 / $num02;
                break;
            default:
                $value = "Invalid operator.";
                break;
        }

        // Display the result
        echo "Result: " . number_format($value, 0); // Format the result to 2 decimal places
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}


?>


</body>
</html>