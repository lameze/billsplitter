<?php
require_once (__DIR__ . '/lib/parsecsv-for-php/parsecsv.lib.php');
error_reporting(E_ALL);
$csv = new parseCSV('Data.csv');

echo "<table border='1'>";
echo '<form action="process.php" method="POST">';
echo '<input type="hidden" name="simey" value="test">';
$transactionss = $csv->data;
foreach ($transactionss as $id => $transactions) {
    $expdate = $transactions['Date'];
    $expdesc = $transactions['Narrative'];
    $debit = $transactions['Debit Amount'];
    $credit = $transactions['Credit Amount'];
    $expense = "<tr>";
    $expense .= "<td><input name='transactions[$id][date]' value='$expdate' size='8'></td>";
    $expense .= "<td><input name='transactions[$id][desc]' value='$expdesc' size='80'></td>";
    $expense .= "<td><input name='transactions[$id][credit]' value='$credit' size='5'></td>";
    $expense .= "<td><input name='transactions[$id][debit]' value='$debit' size='5'></td>";
    $expense .= "<td>" . print_amount_checkbox($id, $debit) . "</td>";
    $expense .= "<td>" . print_share_select($id) . "</td>";
    $expense .= "</tr>";

    echo $expense;
}
echo "</table>";
echo "<input type='submit' value='SEND'>";
echo "</form>";

function print_amount_checkbox($id, $amount) {
    $name = "transactions[$id][selected]";
    $checkbox = "<input type='checkbox' name='$name' value='$amount'>";

    return $checkbox;
}

function print_share_select($id) {
    $name = "transactions[$id][share]";
    $select = "<select name='$name'>";
    $select .= "<option value='100'>100%</option>";
    $select .= "<option value='50' selected>50%</option>";
    $select .= "<option value='40'>40%</option>";
    $select .= "<option value='30'>30%</option>";
    $select .= "</select>";

    return $select;
}