# Todoist Telegram Notifier

Get daily notifications in Telegram about your oldest Todoist items. Don't forget
your old Todo's. Get everyday another Todo(s).

![Preview](http://i.dv.tl/Screenshot_2016-11-27_at_23.54.45.png)

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

# License

## MIT License

### Copyright © 2016 Suat Secmen

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
