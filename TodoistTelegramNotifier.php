<?php
/**
 * @author           Suat Secmen (http://suat.be)
 * @copyright        2016 Suat Secmen
 * @license          MIT License
 */
chdir(__DIR__);
require 'config.inc.php';
require 'inc/functions.inc.php';
require 'inc/todoist.inc.php';
require 'inc/telegram.inc.php';

if (isset($conf['timezone'])) date_default_timezone_set($conf['timezone']);

$resource = getAllTodoistItems();

// execute this task just once a day (good for if you have multiple tasks and
// some of them will be executed more often).
if (!file_exists('/tmp/dailyTodoist') || filemtime('/tmp/dailyTodoist') <= time() - 3600 * 24) {
	for ($i = 0; $i < (isset($conf['tasksPerDay']) ? $conf['tasksPerDay'] : 3); $i++) {
		notifyOldest($resource);
	}
	touch('/tmp/dailyTodoist');
}

// send collected telegram msgs if any exists
sendTelegramMsg();
