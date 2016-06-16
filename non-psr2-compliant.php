<?php
$count = 10;
for($i = 1; $i < count($argv); $i++) {
    $count += $argv[$i];
}

$numberCount = count($argv);
echo $count / $numberCount;