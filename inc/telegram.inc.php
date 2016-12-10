<?php
/**
 * @author           Suat Secmen (http://su.at)
 * @copyright        2016 Suat Secmen
 * @license          MIT License
 */
/**
 * Send a message via telegram to yourself. The messages can be collected and
 * sent alltogether with `sendTelegramMsg()`.
 */
function sendTelegramMsg($msg = null, $collect = true) {
	global $telegram;
	
	$url = 'https://api.telegram.org/bot'.$telegram['botId'].'/sendMessage?'.
				'chat_id='.$telegram['chatId'].'&parse_mode=Markdown&text=';
	if ($msg === null) {
		// send all collected msgs
		if (isset($GLOBALS['telegramMsgs']) && count($GLOBALS['telegramMsgs'])) {
			getSslPage($url.urlencode(implode("\n", $GLOBALS['telegramMsgs'])));
		}
	} elseif ($collect) {
		// collect a msg
		if (!isset($GLOBALS['telegramMsgs'])) $GLOBALS['telegramMsgs'] = [];
		$GLOBALS['telegramMsgs'][] = $msg;
	} else {
		// send a msg directly
		getSslPage($url.urlencode($msg));
	}
}
