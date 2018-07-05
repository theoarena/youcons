<?php

function formatDate($date = null, $pattern = 'Y-m-d')
{    
    $date = ($date == null)?( date($pattern) ):$date;
    $newDate = date($pattern, strtotime($date));
    return $newDate;
}