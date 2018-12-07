<?php

function SieveOfSundaram($n)
{
    $nNew = ($n - 2) / 2;

    $marked = array_fill(0, ($nNew + 1), false);

    for ($i = 1; $i <= $nNew; ++$i)
    {
        for ($j = $i; ($i + $j + 2 * $i * $j) <= $nNew; ++$j)
        {
            $marked[$i + $j + 2 * $i * $j] = true;
        }
    }

    $prime = array();

    if ($n > 2)
    {
        $prime[0] = 2;
    }

    for ($i = 1; $i <= $nNew; ++$i)
    {
        if ($marked[$i] == false)
        {
            $prime[] = 2 * $i + 1;
        }
    }

    return $prime;
}


$sum = 0;
$number_of_primes = 0;

$limit = 1000000;
$primes = SieveOfSundaram($limit);

$primes_sum[0] = 0;
for ($i = 0; $i < count($primes); $i++)
{
    $primes_sum[$i+1] = $primes_sum[$i] + $primes[$i];
}

for ($i = $number_of_primes; $i < count($primes_sum); $i++)
{
    for ($j = $i-($number_of_primes+1); $j >= 0; $j--)
    {
        $difference = $primes_sum[$i] - $primes_sum[$j];

        if ($difference > $limit) break;

        if (in_array($difference, $primes))
        {
            $number_of_primes = $i - $j;
            $sum = $difference;
        }
    }
}

echo "<h3>Output:</h3>";
echo "Sum of most consecutive primes = $sum<br />";

$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
echo "Script executed in $time seconds<br />";
