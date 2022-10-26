<?php
date_default_timezone_set('America/New_York');

require_once(__DIR__ . '/vendor/autoload.php');

class DerpRETS
{
	function __construct()
	{
		$retscfg = file_get_contents(__DIR__ . '/rets-config.json');
		$retscfg = json_decode($retscfg);

		$config = new \PHRETS\Configuration;

		$config
			->setLoginUrl($retscfg->login_url)
			->setUsername($retscfg->username)
			->setPassword($retscfg->password)
			->setRetsVersion($retscfg->rets_version)
			->setUserAgent($retscfg->useragent)
			->setUserAgentPassword($retscfg->useragent_password)
			->setHttpAuthenticationMethod($retscfg->http_auth)
			->setOption('use_post_method', false)
			->setOption('disable_follow_location', false);

		$rets = new \PHRETS\Session($config);

		/* $log = new \Monolog\Logger('PHRETS');
		$log->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout', \Monolog\Logger::DEBUG));
		$rets->setLogger($log); */

		$connect = $rets->Login();
	}

	function __destruct() { }
}
