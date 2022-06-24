<?php

$db = new PDO('sqlite::memory:');
$import = fopen(__DIR__.'/schema.sql','r');
while ($line = fread($import,4096)) {
    $db->exec($line);
}
fclose($import);