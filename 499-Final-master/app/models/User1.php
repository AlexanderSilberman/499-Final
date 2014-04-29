<?php

class User extends Eloquent {
   public static function validate($input){
        return Validator::make($input, [
            'Username' => 'required|min:3|alpha_num',
            'Password' => 'required|min:3|alpha_num',
            'ConfirmPassword' => 'required|min:3|alpha_num|same:Password',
        ]);
    }

}
?>