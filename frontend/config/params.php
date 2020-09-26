<?php
use common\models\Preference;
$pre = new Preference();
$pre->loadfromfile();
return [
    'adminEmail' => 'admin@example.com',
    'deptname' => $pre->getDisplayName(),
];
