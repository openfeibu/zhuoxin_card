<?php

return [

    /*
     * Modules .
     */
    'modules'  => ['page_view'],


    /*
     * Views for the page  .
     */
    'views'    => ['default' => 'Default', 'left' => 'Left menu', 'right' => 'Right menu'],

// Modale variables for page module.
    'page_view'     => [
        'model'        => 'App\Models\PageView',
        'table'        => 'page_views',
        'primaryKey'   => 'id',
        'hidden'       => [],
        'visible'      => [],
        'guarded'      => ['*'],
        //'slugs'        => ['slug' => 'name'],
        'fillable'     => ['user_id','pageable_type','pageable_id'],
        'translate'    => [],
        'upload_folder' => '/banner',
        'encrypt'      => ['id'],
        'revision'     => ['title'],
        'perPage'      => '20',
        'search'        => [
        ],
    ],

];
