<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Source Driver
    |--------------------------------------------------------------------------
    |
    | Press allows you to select a driver that will be used for storing your
    | blog posts. By default, the file driver is used, however, additional
    | drivers are available, or write your own custom driver to suite.
    |
    | Supported: "file"
    |
    */
    "store_type"=>"storage",
    
    "temporary"=>true,
    "ttl"=>60,
    "encrypt"=>true,
];
