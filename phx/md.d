<?php

$a = "px_1.csv";

preg_match("/^px_(\d)\.(\w+)$/", $a, $m);

var_dump($m);
