<?php

use App\Models\Delivery;
use App\Models\Freight;
use App\Models\FreightApproval;





function errorParse($array){
    $array = json_decode($array);
    $all = []; $s = '';
    foreach ($array as $error){
        for($i = 0; $i < count($error); $i++){
            $all[] = $error[$i];
        }
    }
    foreach($all as $a) {
        $s .= $a. '<br>';
    }
    return $s;
}


function money($amt)
{
    return '$ '.number_format($amt, 2);
}

function UserRole($role)
{
    $name = '';
    if($role == 1) {
        $name = 'Driver';
    }else if($role == 3){
        $name = 'Staff';
    }else if($role == 5){
        $name = 'Super Admin';
    }else if($role == 0)
    {
        $name = 'Inactive account';
    }

    return $name;
}


function appointment($apt)
{
    if($apt == 1){
        $t = '<div class="badge bg-primary">Appoiment Is Required</div>';
    }else {
        $t = '<div class="badge bg-secondary">Appoiment Not Required</div>';
    }
    return $t;
}



function deliveryProStatus($status)
{
    $color = '';
    if($status == 3){
       $color = 'primary'; $title = 'OFD';
    }else if($status == 4){
        $color = 'secondary'; $title = 'OFD';
     }elseif($status == 5){
        $color = 'success'; $title = 'DEL';
    }elseif($status == 6){
        $color = 'danger'; $title = 'RFS';
    }else{
        $color = ''; $title = '...';
    }
    $string  = '<div class="badge bg-'.$color.'">'.$title.'</div>';
    return $string;
}


function deliveryStatus($status)
{
    $color = '';
    if($status == 3){
       $color = 'primary'; $title = 'Out For Delivery';
    }else if($status == 4){
        $color = 'secondary'; $title = 'Out For Delivery';
     }else if($status == 2){
        $color = 'secondary'; $title = 'Approved';
     }else if($status == 1){
        $color = 'secondary'; $title = 'Pending';
     }elseif($status == 5){
        $color = 'success'; $title = 'Delivered';
    }elseif($status == 6){
        $color = 'danger'; $title = 'Refused';
    }else{
        $color = 'warning'; $title = 'Not Assigned';
    }
    // $string  = '<div class="badge bg-'.$color.'">'.$title.'</div>';
    return $title;
}








function freightProStatus($status, $title)
{
    $color = '';
    if($status == 0){
       $color = 'danger';
    }elseif($status == 2){
        $color = 'warning';
    }elseif($status == 3){
        $color = 'primary';
    }elseif($status == 4){
        $color = 'secondary';
    }elseif($status == 5){
        $color = 'success';
    }
    $string  = '<div class="badge bg-'.$color.'">'.$title.'</div>';
    return $string;
}



function freightStatus($status)
{
    $title = '';  $color = '';
    if($status == 0){
        $title = 'Awaiting Approval'; $color = 'danger';
    }elseif($status == 2){
        $title = 'Approved'; $color = 'warning';
    }elseif($status == 3){
        $title = 'Assiginig'; $color = 'primary';
    }elseif($status == 4){
        $title = 'Assiginig Completed'; $color = 'secondary';
    }elseif($status == 5){
        $title = 'Completed'; $color = 'success';
    }
    $string  = '<div class="badge bg-'.$color.'">'.$title.'</div>';
    return $string;
}


function freightBgPick($status, $title)
{
    $color = '';
    if($status == 0){
       $color = 'danger';
    }elseif($status == 2){
        $color = 'warning';
    }elseif($status == 3){
        $color = 'primary';
    }elseif($status == 4){
        $color = 'secondary';
    }elseif($status == 5){
        $color = 'success';
    }
    $string  = '<div class="badge bg-'.$color.'">'.$title.'</div>';
    return $string;
}





// function deliveryStatus($status)
// {
//     $title = '';  $color = '';
//     if($status == 0){
//         $title = 'Delivery Pending'; $color = 'secondary';
//     }elseif($status == 1){
//         $title = 'Delivered'; $color = 'success';
//     }elseif($status == 3){
//         $title = 'Not Delivered'; $color = 'danger';
//     }
//     $string  = '<div class="badge bg-'.$color.'">'.$title.'</div>';
//     return $string;
// }


// function totalF

