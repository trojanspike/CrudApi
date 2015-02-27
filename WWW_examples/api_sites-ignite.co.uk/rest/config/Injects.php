<?php


Api::inject('DB1', 'Database');
Api::inject('user', 'trojanSpike');
Api::inject('DB', new PDO('sqlite:../DB.sqlite', null, null, array(PDO::ATTR_PERSISTENT => true)));


Api::inject('Data', [
    'town'  => 'Newry',
    'name' => 'Lee',
    'age' => 32
]);

?>