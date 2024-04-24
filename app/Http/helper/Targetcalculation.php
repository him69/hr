<?php

namespace App\Http\Helper;

  class Targetcalculation
    {
        public static function targetSolution($user,$user_targer,$user_lead){
            if ($user->server_ip == '144.76.0.239') {
                $bttf = (($user->salary / 1000) / 100);
                $targ = round($bttf * $user_targer);
                $leadtarg = $user_lead;
                // $ftarg = round($bttf * 100);
            } else {
                $targ = $user_targer;
                $leadtarg = $user_lead;
            }
    
            return [
                'targ' => $targ,
                'leadtarg' => $leadtarg,
            ];
        } 
    
    
    
}