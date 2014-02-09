<?php

if(!defined("IN_MYBB"))
{
	die('Nope');
}

$plugins->add_hook("global_end", "blocktor");

function blocktor_info()
{
	return array(
		"name"			=> "Block Tor",
		"description"	=> "Blocks people browsing with the Tor network.",
		"website"		=> "https://github.com/PenguinPaul/block-tor",
		"author"		=> "Paul Hedman",
		"authorsite"	=> "http://www.paulhedman.com",
		"version"		=> "1.0",
		"guid" 			=> "",
		"compatibility" => "*"
	);
}

function blocktor()
{
	global $session,$lang;
	
	$lang->load('blocktor');
	
	$cip = $session->ipaddress;
	$cip = explode('.',$cip);
	$cip = $cip[3].'.'.$cip[2].'.'.$cip[1].'.'.$cip[0];
	
	$sip = $_SERVER['SERVER_ADDR'];
	$sip = explode('.',$sip);
	$sip = $sip[3].'.'.$sip[2].'.'.$sip[1].'.'.$sip[0];
	
	$host = gethostbyname($cip.'.'.$_SERVER['SERVER_PORT'].'.'.$sip.'.ip-port.exitlist.torproject.org');

	if($host == '127.0.0.2') {
		error($lang->tor_disabled);
	}	
}

?>
