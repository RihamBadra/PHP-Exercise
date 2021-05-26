<?php 
$salary = $salarytype = $taxallowance = "";
$salary_error = $salarytype_error = $taxallowance_error = "";

function show_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["salary"])) {
        $salary_error = "Can't be empty!!";
    } else {
        $salary = show_data($_POST["salary"]);
        if(!is_numeric($salary)) {
            $salary_error = "Can't be empty!!";
        }
    }

    if(empty($_POST["salarytype"])) {
        $salarytype_error = "Can't be empty!!";
    } else {
        $salarytype = show_data($_POST["salarytype"]);
    }

    if(empty($_POST["taxallowance"])) {
        $taxallowance_error = "Can't be empty!!";
    } else {
        $taxallowance = show_data($_POST["taxallowance"]);
        if(!is_numeric($taxallowance)) {
            $taxallowance_error = "Can't be empty!!";
        }
    }

    $totalsalary = $annualsalary = $annualtaxallowance = $taxamount = $yearlysocialsecurityfee = 0;
    if(isset($salarytype) && $salarytype == "Yearly-Salary") {
        $annualsalary = $salary;
        $annualtaxallowance = $taxallowance;    
     }elseif(isset($salarytype) && $salarytype == "Montly-Salary") {
        $annualsalary = $salary * 12;
        $annualtaxallowance = $taxallowance * 12;
    }

    if($annualsalary < 10000) {
        $totalsalary = $annualsalary + $annualtaxallowance;
    } elseif($annualsalary > 10000 && $annualsalary < 25000) {
        $taxamount = $annualsalary * 0.11;
        $yearlysocialsecurityfee = $annualsalary * 0.04;
        $totalsalary = ($annualsalary - ($taxamount + $yearlysocialsecurityfee)) + $annualtaxallowance;
    } elseif($annualsalary > 25000 && $annualsalary < 50000) {
        $taxamount = $annualsalary * 0.30;
        $yearlysocialsecurityfee = $annualsalary * 0.04;
        $totalsalary = ($annualsalary - ($taxamount + $yearlysocialsecurityfee)) + $annualtaxallowance;
    } else {
        $taxamount = $annualsalary * 0.45;
        $yearlysocialsecurityfee = $annualsalary * 0.04;
        $totalsalary = ($annualsalary - ($taxamount + $yearlysocialsecurityfee)) + $annualtaxallowance;
    }
    $montlysalary = $montlytaxamount = $monthlysocialsecurityfee = $monthlytotalsalary = 0;
    $monthlysalary = $annualsalary / 12;
    $monthlytaxamount = $taxamount / 12;
    $monthlysocialsecurityfee = $yearlysocialsecurityfee / 12;
    $monthlytotalsalary = $totalsalary / 12;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Tax Calculator</title>
</head>
<body>
    <h3>Salary Income Tax Calculator Based On Salary</h3>
    <form method="POST" action="calc.php">
        <label for="salary">Salary in USD:</label><br>
        <input type="text" name="salary" id="salary"><br>
        <span class="err"><?php echo $salary_error ?></span> 
        <br>
        <label for="salarytype">Salary:</label> <br>
        Montly Salary: <input type="radio" name="salarytype" id="salarytype" <?php if(isset($salarytype) && $salarytype == "Monthly-Salary") {echo "On";}; ?> value="Montly-Salary">
        Yearly Salary: <input type="radio" name="salarytype" id="salarytype" <?php if(isset($salarytype) && $salarytype == "Yearly-Salary") {echo "On";} ?> value="Yearly-Salary">
        <br>
        <span class="err"><?php echo $salarytype_error ?></span>
        <br>
        <label for="taxallowance">Tax Free Allowance in USD:</label>
        <input type="text" name="taxallowance" id="taxallowance"><br>
        <span class="err"><?php echo $taxallowance_error ?></span>
        <br>
        <div class="button">
            <input type="submit" name="submit" value="Calculate Now">
        </div>
    </form>
    <br>
    <div class="final-product">
        <?php
                echo "
                <table>
                <tr>
                    <th>Income with Taxes</th>
                    <th>Monthly</th>
                    <th>Yearly</th>
                </tr>
                <tr>
                    <td>Total Salary</td>
                    <td>$monthlysalary</td>
                    <td>$annualsalary</td>
                </tr>
                <tr>
                    <td>Tax Amount</td>
                    <td>$monthlytaxamount</td>
                    <td>$taxamount</td>
                </tr>
                <tr>
                    <td>Social Security Fee</td>
                    <td>$monthlysocialsecurityfee</td>
                    <td>$yearlysocialsecurityfee</td>
                </tr>
                <tr>
                    <td>Salary After Tax</td>
                    <td>$monthlytotalsalary</td>
                    <td>$totalsalary</td>
                </tr>
            </table>";
               
        ?>
    </div>
</body>
</html>


