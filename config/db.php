<?
if (isset($_SESSION['dev'])) {
	return array (
    'Host' => '176.126.165.135',
    'HostDb' => 'user41367_dev',
    'user' => 'user41367_dev',
    'password' => '0Y6n5V9o',
	);
} else {
	return array (
		'Host' => '176.126.165.135',
		'HostDb' => 'user41367_db',
		'user' => 'user41367_db',
		'password' => '0D1q8F3b',
	);
}
?>