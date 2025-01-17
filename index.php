<?php
function CalculatePay($rate,$cost,$contribution,$period){
    $monthRate = $rate / 12;
    $totalRate = (1 + $monthRate) ** $period;
    $loanSum = $cost-$contribution;
    $monthPay = round($loanSum * $monthRate * $totalRate / ($totalRate - 1), 0);
    $paymentsByMonth =[];
    for ($i = 0; $i < $period; $i++){
        $interestPayment = round($loanSum*$monthRate,0);
        $basicPayment = $monthPay - $interestPayment;
        $loanSum-=$basicPayment;
        $paymentsByMonth[$i+1] = [ "basicPayment" => $basicPayment, "loanPayment" => $interestPayment, "balance" => $loanSum];
    }
    return $paymentsByMonth;
}
$rate = (float)readline("Годовая ставка:");
$cost = (float)readline("Стоимость недвижимости:");
$contribution = (float)readline("Размер первоначального взноса:");
$period = (int)readline("Cрок ипотеки в месяцах:");
print_r(CalculatePay($rate,$cost,$contribution,$period));

?>