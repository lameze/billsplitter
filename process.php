<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


$post = $_POST;
echo "<pre>";
//print_r($_POST);
echo "<table border='1'>";
echo "<tr>";
echo "<td>Data</td>";
echo "<td>Descricao</td>";
echo "<td>Valor Total</td>";
echo "<td>Valor baby</td>";
echo "</tr>";
$total = 0;
$total_mimey = 0;
$total_baby = 0;
foreach ($post['transactions'] as $i => $v) {
    if (isset($v['selected']) && !empty($v['debit'])) {
        $valor_baby = ($v['share'] / 100) * $v['debit'];
        $total_baby += $valor_baby;
        $total_mimey += $v['debit'];
        echo "<tr>";
        echo "<td>".$v['date']."</td>";
        echo "<td>".$v['desc']."</td>";
        echo "<td>".$v['debit']."</td>";
        echo "<td>".$valor_baby."</td>";
        echo "</tr>";
    }
}
echo "<tr>";
echo "<td colspan='2'>Total</td>";
echo "<td>".$total_mimey."</td>";
echo "<td>".$total_baby."</td>";
echo "</tr>";
echo "</table>";