# Todoist Telegram Notifier

Get daily notifications in Telegram about your oldest Todoist items. Don't forget
your old Todo's. Get everyday another Todo(s).

## Config

First rename config.inc.sample.php into config.inc.php. Open the file with an
editor and fill out the config variables.

### Todoist API Token

In Todoist go to Todoist Settings > Account and copy your API token into the
config file.

### Telegram Bot ID

If you have a Telegram Bot you can use it to let you notify you. If not you can
easily create a new bot. Open Telegram and search for the user `Botfather`.  
Send it the message `/start`, then `/newbot`, give your bot a name, then a
username ending with "bot" and you get the token. Add it into the config file.

Official Telegram Bot documentation: https://core.telegram.org/bots#3-how-do-i-create-a-bot

### Telegram Chat ID

The bot has to contact YOU so you have to know your chatId. Write a message to
your bot (search for it's username in Telegram, start it, and write a message,
anything, doesn't matter what :D).

Open your Terminal and run:  
`curl -s https://api.telegram.org/bot{BotId}/getUpdates | php -r 'preg_match("~^.*\"id\":(\d+).*$~s",file_get_contents("php://stdin"),$m);echo "$m[1]\n";'`  
(replace `{BotId}` with your Telegram Bot ID token, don't replace the `/bot`
part.)  
If the output is empty maybe send another message to your bot and try it again.
If it still doesn't work maybe you get more details on your error by running:  
`curl -i https://api.telegram.org/bot{BotId}/getUpdates`

## Run

Test the script by running:  
`php -f $HOME/path/to/script/TodoistTelegramNotifier.php`

You should get a Telegram message.

## Cron Job

Create a daily cron job and run your script:  
`crontab -e`  
`0 15 * * * php -f $HOME/path/to/script/TodoistTelegramNotifier.php`
