<?php

class Favorites extends Eloquent {
 public static function validating($input){
        return Validator::make($input, [
            'user_id' => 'unique_with:favorites,manga_id|required',
            'manga_id' => 'required',
        ]);
    }

}
?>