<?php
return [
    'code' => [
        //for job CRUD
        'people_create' => 'People|Create',
        'people_read'   => 'People|Read',
        'people_update' => 'People|Update',
        'people_delete' => 'People|Delete',

        //For Job CRUD
        'job_create' => 'Job|Create',
        'job_read'   => 'Job|Read',
        'job_update' => 'Job|Update',
        'job_delete' => 'Job|Delete',


        //for Person History CRUD
        'person_history_create' => 'Person_History|Create',
        'person_history_read'   => 'Person_History|Read',
        'person_history_update' => 'Person_History|Update',
        'person_history_delete' => 'Person_History|Delete',
     
    ],
    'action' => [
        'Create' => 'Create',
        'Read'   => 'Read',
        'Update' => 'Update',
        'Delete' => 'Delete'
    ],
    'table' => [
        'Person_History' => 'person_history',
        'Job'            => 'Job',
        'People'         => 'People'
    ]

];