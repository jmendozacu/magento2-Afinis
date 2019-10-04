#!php

<?php

echo "Enter remote path (format protocol://username:password@host:port) : ";
$remote = stream_get_line(STDIN, 1024, PHP_EOL);
exec('stty echo');

return [
    'my site' => [
        	'remote' => $remote,
		'local' => '.',
		'test' => false,
		'ignore' => '
			/temp/*
			!temp/.htaccess
			/log/*
			/.log
			/app/config/*
			!/app/config/config.neon
			.git/
			.gitignore
			.gitattributes
			/composer.json
			/composer.lock
			/deployment.php
			/web/editor_uploads/*
			/web/images/*
		',

		'include' => '
        ',

		'allowDelete' => true,
		'before' => [
			function (Deployment\Server $server, Deployment\Logger $logger, Deployment\Deployer $deployer) {
				$logger->log('Hello!');
			},
		],
		'afterUpload' => [
			'http://example.com/deployment.php?afterUpload',
		],
		'after' => [
			'http://example.com/deployment.php?after',
		],
		'purge' => [
			'temp/cache',
			'web/webtemp'
		],
		'preprocess' => ['combined.js', 'combined.css'],
	],

	'tempDir' => __DIR__ . '/temp',
	'colors' => true,
];
