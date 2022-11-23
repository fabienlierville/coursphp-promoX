<?php

function have_good_role(array $rolesCompatibles) :bool{
    session_start();
    if(isset($_SESSION["Login"]) && isset($_SESSION["Login"]["role"])){
        return in_array(needle: $_SESSION["Login"]["role"], haystack: $rolesCompatibles );
    }else{
        return false;
    }
}
