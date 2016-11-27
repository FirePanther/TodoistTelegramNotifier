<?php
/**
 * @author           Suat Secmen (http://suat.be)
 * @copyright        2016 Suat Secmen
 * @license          MIT License
 */
// configs
$conf = [
	// you will get a single message with this number of ToDo's.
	'tasksPerDay' => 3,
	
	// your timezone: http://php.net/manual/en/timezones.php
	// you can remove this key if your timezone is in your php.ini
	'timezone' => 'Europe/Berlin'
];

// todoist
$todoist = [
	// todoist token
	// @see Todoist Settings > Account > API Token)
	'token' => ''
];

// telegram
$telegram = [
	// the token of your bot
	// @see README.md or https://core.telegram.org/bots#3-how-do-i-create-a-bot
	'botId' => '',
	
	// read the README.md to know how to get your chat_id or just look here:
	// https://api.telegram.org/bot{BotId}/getUpdates
	'chatId' => ''
];
