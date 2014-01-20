<?php
	echo "[constants]" . PHP_EOL;
	echo " PASSWORD_BCYRPT: " . PASSWORD_BCRYPT . PHP_EOL;
	echo " PASSWORD_DEFAULT: " . PASSWORD_DEFAULT . PHP_EOL;
	echo PHP_EOL;

	echo "[password_get_info]" . PHP_EOL;
	$raw_passwd = 'password';
	$hashed_passwd = password_hash($raw_passwd,
	                      PASSWORD_DEFAULT);
	echo '  hash:' . $hashed_passwd . PHP_EOL;
	$info = password_get_info($hashed_passwd);
	var_dump($info);
	$hashed_passwd = password_hash($raw_passwd,
	                      PASSWORD_BCRYPT,
	                      ['cost' => 12]);
	echo '  hash:' . $hashed_passwd . PHP_EOL;
	$info = password_get_info($hashed_passwd);
	var_dump($info);
	echo PHP_EOL;

	echo "[password_verify]" . PHP_EOL;
	$hashes = [
		// 'passward' という生パスワードのハッシュ
		'$2y$10$37kyZdEjY93uMWG.jA2Ih.uK7.ByZ3hQbXp5/4ax4ffRj4eoFe8R2',
		'$2y$10$.N1X2eBVd.64TBf0rCLq8euq8Iuo8pRM8GX15Ak295u3dQcIyM8N6',
		'$2y$10$m/s8j4AdbwQX1Z2xOOkvQusCngeCPp28JjZYLqeOzJ18XXvQ9lq3W',
	];

	foreach ($hashes as $hash) {
		if(password_verify($raw_passwd, $hash)) {
			echo '  valid' . PHP_EOL;
		} else {
			echo '  invalid' . PHP_EOL;
		}
	}

	echo "[password_verify]" . PHP_EOL;
