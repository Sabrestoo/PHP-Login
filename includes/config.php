<?php

if (!defined('__CONFIG__')) {
    //Redirect or 404 page here instead of exit
    exit('You do not have a config file');
}

require 'classes/db.php';

$conn = DB::get_connection();