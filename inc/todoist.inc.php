<?php
/**
 * @author           Suat Secmen (http://su.at)
 * @copyright        2016 Suat Secmen
 * @license          MIT License
 */
/**
 * Gets all todoist resources
 */
function getAllTodoistItems() {
	global $todoist;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://todoist.com/API/v7/sync');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	$post = [
		'token' => $todoist['token'],
		'seq_no' => 0,
		'resource_types' => '["all"]'
	];
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$json = curl_exec($ch);
	curl_close($ch);
	$arr = @json_decode($json, 1);
	if (!isset($arr['items'])) {
		throw new Exception('Something went wrong with the Todoist API.');
	}
	return $arr;
}

/**
 * Gets the oldest undone and already notified item and notifies it via telegram
 */
function notifyOldest($resource) {
	$items = $resource['items'];
	
	// clean up old caches
	$s = scandir('data');
	foreach ($s as $f) {
		if (substr($f, 0, 7) == 'oldest-' && filemtime('data/'.$f) < time() - 3600 * 24 * 60) {
			@unlink('data/'.$f);
		}
	}
	
	$oldestDate = $oldestItem = 0;
	
	// get the oldest unchecked and not already notified todoist id
	foreach ($items as $item) {
		if (!$item['checked'] && !file_exists('data/oldest-'.$item['id'])) {
			$added = strtotime($item['date_added']);
			if ($oldestDate == 0 || $oldestDate > $added) {
				$oldestDate = $added;
				$oldestItem = $item;
			}
		}
	}
	
	if ($oldestDate) {
		// post via telegram
		sendTelegramMsg('🗓 *Old Todoist Items*: '.$oldestItem['content'].' (from '.date('Y-m-d', $oldestDate).')');
		touch('data/oldest-'.$oldestItem['id']);
	}
}
