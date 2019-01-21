<?php

// date ( string $format [, int $timestamp = time() ] ) : string
$today = date('Y-m-d H:i:s');


// strtotime ( string $time [, int $now = time() ] ) : int
$tomorrow = date('Y-m-d', strtotime($today . "+1 day"));
$tenDaysAgo = date('Y-m-d H:i:s', strtotime($today . "+10 days"));
$thirtyDaysBefore = date('Y/m/d', strtotime($today . "-30 days"));

 ?>
