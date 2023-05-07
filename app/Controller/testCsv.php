<?php

$handle = fopen("./data/testcsv.csv", 'r+');
//$data = ['googleId', 'accessCount'];
//$data2 = ['dyKMDQAAQBAJ', '1'];
//fputcsv($handle, $data, ';');
//fputcsv($handle, $data2, ';');
$lignFound = false;
$lign = fgetcsv($handle, separator: ";");
$currentId1 = "abc";
$currentId2 = "dyKMDQAAQBAJ";
while ($lign != false && !$lignFound) {
    $p = ftell($handle);
    $lign = fgetcsv($handle, separator: ";");
    print_r($lign);
    if (!empty($lign) && $lign[0] == $currentId1) {
        fseek($handle, $p);
        fputcsv($handle, [$lign[0], ++$lign[1]], ";");
        $lignFound = true;
    }
}
if (!$lignFound) {
    fputcsv($handle, [$currentId1, 1], ";");
}