<?php
function checkDB($table,$col,$item) {
    global $con;
$query = $con->prepare("SELECT * FROM $table WHERE $col=?");
$query->execute(array($item));
return $query->rowCount() > 0;
}
function generateSerial() {
    $chars = [0,1,2,3,4,5,6,7,8,9];
    $serial = [];
    for ($i = 0; $i < 8; $i++) {
        $serial[] = array_push($serial, array_rand($chars));
    }
    return implode($serial);
}