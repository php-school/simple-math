<?php
$count = 0;
for ($i = 1; $i < count($argv); $i++) {
    $count += $argv[$i];
}

$numberCount = count($argv) - 1;
echo $count / $numberCount;
