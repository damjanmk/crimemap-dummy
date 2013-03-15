<?php

function i_to_type($s) {
    switch ($s) {
        case 0:
            return "weapons";
            break;
        case 1:
            return "violence";
            break;
        case 2:
            return "theft";
            break;
        case 3:
            return "documents";
            break;
        case 4:
            return "drugs";
            break;
        case 5:
            return "traffic";
            break;
        case 6:
            return "other";
            break;
        default:
            break;
    }
}

function i_to_day($dn) {
    switch ($dn) {
        case 2:
            return "Monday";
            break;
        case 3:
            return "Tuesday";
            break;
        case 4:
            return "Wednesday";
            break;
        case 5:
            return "Thursday";
            break;
        case 6:
            return "Friday";
            break;
        case 0:
            return "Saturday";
            break;
        case 1:
            return "Sunday";
            break;
        default:
            break;
    }
}
?>
