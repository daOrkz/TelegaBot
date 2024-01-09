# telegramBot

## config.ini

```
[telegramBot]
token = ''
apiTelegramUrl = 'https://api.telegram.org/bot'
chatId = ''
userId = ''
adminId = ''

[log]
logDir = 'Logs'
logFile = '/logs.txt'

[ngrok]
ngrokURL = ''
```
*[telegramBot]*   
**token** - токен телеграмм бота   
**apiTelegramUrl** - базовый URL API команд бота   
**chatId** - ID конкретного чата для тестирования бота   
**userId** - ID конкретного пользователя для тестирования бота   
**adminId** - ID админа для отправки сообщений об ошибках.

*[log]*   
**logDir** - папка для сохранения логов   
**logFile** - имя файлов логов   


## Инициализация бота WebHook через ngrok

- Прописать URL который получаем из ngrok в файл config.ini
```
[ngrok]
ngrokURL = ''
```

- запустить скрипт `http://localhost/init.php`. Будет показан результат об успешной или проваьной инициализации WebHook

## Команды телеграмм бота

**/start** - стартовая команда приветствия   
**/time** - показать текущее время   
**/weather** - показать текущую погоду   
**forecast** - показать прогноз погоды на 3 дня. Срабатывает через callback inline_kyboard команды `/weather` > :warning: **Не команда, a callback!!!**. Пишется без "/"
