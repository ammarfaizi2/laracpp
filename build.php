#!/usr/bin/env php
<?php

if (trim(shell_exec("whoami")) !== "root") {
	print "You need to run this script as root!\n";
	exit(1);
}

$descriptorspec = [
   0 => ["pipe", "w"], // STDIN
   1 => ["file", "php://stdout", "w"], // STDOUT
   2 => ["file", "php://stderr", "w"]  // STDERR
];

$sh = function () {
	$a = [
		"/usr/lib/libphpcpp.a.2.1.1",
		"/usr/lib/libphpcpp.a",
		"/usr/lib/libphpcpp.so",
		"/usr/lib/libphpcpp.so.2.1.1",
		"/usr/lib/libphpcpp.so.2.1",
		"/usr/include/phpcpp",
		"/usr/include/phpcpp.h"
	];
	$c = true;
	foreach ($a as $v) {
		$c = $c && file_exists($v);
		if (!$c) {
			return true;
		}
	}
	return false;
};

$sd = __DIR__."/libphpcpp";
is_dir($sd) or mkdir($sd);

$commands = [
	[
		(!file_exists($sd."/phpcpp.tar")),
		"wget https://api.github.com/repos/CopernicaMarketingSoftware/PHP-CPP/tarball/v2.1.2 -O {$sd}/phpcpp.tar"
	],
	[
		(!$sh()),
		"cd {$sd} && tar -xf phpcpp.tar && cd *PHP* && make -j2 && make install"
	],
	[
		true,
		"composer install -n --prefer-dist -vvv"
	],
];


foreach($commands as $command) {
	if ($command[0]) {
		$proc = proc_open($command[1], $descriptorspec, $pipes);
		fclose($pipes[0]);
		proc_close($proc);
	}
}

