<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Filesystem
    |--------------------------------------------------------------------------
    |
    | Here you can select if you are using filesystem when uploading media files.
    |
    |
    |
    | Supported: true, false.
    |
    | note: When selecting "false". We assume that you upload the files directly in the Public folder of your Laravel application.
    |
    |
    */
    "filesystem"=>true,
     /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you can configure the filesystem "disks" as it would normally be used.
    | Supported disks: "local", "public"
    |
    */
    "disk"=>"local",
    /*
    |--------------------------------------------------------------------------
    | Time to live
    |--------------------------------------------------------------------------
    |
    | Specify the length of time (in minutes) that the token will be valid for.
    | Defaults to 1 hour.
    |
    |
    */
    "ttl"=>60,
    /*
    |--------------------------------------------------------------------------
    | Path encryption
    |--------------------------------------------------------------------------
    |
    | Here you can specify if the path of the media file can be shown or encrypted in the generated url.
    |
    |
    */
    "encrypt"=>true,
];
