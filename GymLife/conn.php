<?php
require_once 'db.class.php';
require_once 'functions.php';

//Database Setting
DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'gymlife';

/*var_dump(DB::query("SELECT * FROM user"));

DB::insert('user', array(
  'name' => $name,
  'age' => 23,
  'height' => 10.75
));

DB::update('user', array(
  'age' => 25,
  'height' => 10.99
), "userid=%s", $name);

DB::delete('user', "userid=%s", '123');*/

?>