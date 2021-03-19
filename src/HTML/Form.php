<?php

namespace App\HTML;

class Form{

    public static function textinput($name,$value,$id)
    {
        return <<<HTML
            <input class="form-control" type="text" placeholder="" name="$name" id="$id" value="$value">
            <label for="$name" >$name</label>

        HTML;
    }

}