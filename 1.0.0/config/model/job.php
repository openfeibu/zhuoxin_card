<?php

return [

    /*
     * Modules .
     */
    'modules'  => ['job'],


    /*
     * Views for the page  .
     */
    'views'    => ['default' => 'Default', 'left' => 'Left menu', 'right' => 'Right menu'],

// Modale variables for page module.
    'category'     => [
        'model'        => 'App\Models\JobCategory',
        'table'        => 'job_categories',
        'primaryKey'   => 'id',
        'hidden'       => [],
        'visible'      => [],
        'guarded'      => ['*'],
        //'slugs'        => ['slug' => 'name'],
        'fillable'     => ['name','parent_id','order'],
        'translate'    => ['name'],
        'upload_folder' => '/banner',
        'encrypt'      => ['id'],
        'revision'     => ['title'],
        'perPage'      => '20',
        'search'        => [
            'name' => 'like',
        ],

    ],
    'job'     => [
        'model'        => 'App\Models\Job',
        'table'        => 'jobs',
        'primaryKey'   => 'id',
        'hidden'       => [],
        'visible'      => [],
        'guarded'      => ['*'],
        //'slugs'        => ['slug' => 'name'],
        'fillable'     => ['id',  'name', 'en_name','order'],
        'translate'    => ['name'],
        'upload_folder' => '/banner',
        'encrypt'      => ['id'],
        'revision'     => ['title'],
        'perPage'      => '20',
        'search'        => [
            'name' => 'like',
        ],

    ],
    'employee'     => [
        'model'        => 'App\Models\Employee',
        'table'        => 'employees',
        'primaryKey'   => 'id',
        'hidden'       => [],
        'visible'      => [],
        'guarded'      => ['*'],
        //'slugs'        => ['slug' => 'name'],
        'fillable'     => ['id','job_category_id','image', 'name', 'en_name', 'phone_number', 'tel', 'email', 'intro', 'en_intro', 'address', 'en_address', 'wechat_qrcode', 'education', 'en_education', 'field', 'en_field', 'employment_record', 'en_employment_record', 'language', 'en_language', 'work_experience', 'en_work_experience', 'social_duties_honors', 'en_social_duties_honors', 'professional_book', 'en_professional_book','card_qrcode', 'order'],
        'translate'    => ['name'],
        'upload_folder' => '/employee',
        'encrypt'      => ['id'],
        'revision'     => ['title'],
        'perPage'      => '20',
        'search'        => [
            'name' => 'like',
        ],

    ],
];
