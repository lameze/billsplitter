<?php
require_once ('lib/parsecsv-for-php/parsecsv.lib.php');
error_reporting(E_ALL);
$csv = new parseCSV('Data.csv');
//echo "<pre>";
//print_r($csv->data);
echo "<table border='1'>";
echo '<form action="process.php" method="POST">';
echo '<input type="hidden" name="simey" value="test">';
$transactionss = $csv->data;
foreach ($transactionss as $id => $transactions) {

//    [0] => Array
//    (
//        [Bank Account] => 733072717607
//            [Date] => 21/03/16
//            [Narrative] => DEBIT CARD PURCHASE TARGET 5057 EAST VICTORI AUS
//            [Debit Amount] => 20.00
//            [Credit Amount] =>
//            [Categories] => PAYMENT
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