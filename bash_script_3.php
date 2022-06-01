<?php
$dirMonths = dirMonths();
$data1 = "
echo 'Смотрим где мы находимся '
echo
pwd  
echo
echo '-------------------------------' 
echo 'Создаем папку  '  
echo       
mkdir Dir
ls
echo
echo '-------------------------------' 
echo 'переходим в эту папку  '  
echo
cd Dir
pwd
echo
echo '-------------------------------' 
echo 'Создаем 12 папок с названием месяцов  '  
echo 
mkdir $dirMonths 
ls
echo 
echo '-------------------------------' 
" ;
// С начало создаем папки
$output1 = shell_exec($data1);

$listMonths =listMonths();
$nowMonth = parsingMonths($listMonths);
$pathDir = end($listMonths);
$tomorow = day($nowMonth);
$text ='В ' . $tomorow . ' 10:00 собеседование. ' .  'Так же само можно настроить crontab для расписание';
$data2 = "
echo 'Находим папку с названием нынешнего месяца и заходим в нее'  
echo 
$pathDir/$nowMonth
pwd
echo 
echo '-------------------------------'                  
echo 'Создаем текстовый блокнот и пишем что завтра собеседование ' 
echo 
echo $text >> remember.txt
ls
" ;

// Потом парсим папки выберем какую нам надо и создаем текстовый файл в ней
$output2 = shell_exec($data2);
//Вывод результата в браузер
echo "<pre>$output1</pre>";
echo "<pre>$output2</pre>";


//Создание папки по списку
function dirMonths()
{
    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
        'November', 'December'];
    foreach ($months as $v) {
        $listMonths .= ' ' . $v;
    }
    return $listMonths;
}

// получаем список папок, что находится в каталоге
function listMonths() {
    // узнаем путь и добавляем папку
    $path = shell_exec('pwd') ;
    // задаем команду для перехода в папку, убираем перенос строки и экранирует кавычки (если в пути будут пробелы)
    $path = 'cd ' . '"' . trim($path) . '/Dir' . '"' ;
    $a = "$path  
    ls 
    ";
    // выводит строку с месяцами, но есть перенос строки
    $listMonths = shell_exec($a) ;
    // добавляем символ переноса строки
    $listMonths = nl2br($listMonths);
    // заменяем символ переноса строки на разделитель b
    $listMonths =  str_replace('<br />', ' b', $listMonths);
    // Разбивает строку с помощью разделителя b и формируем массив
    $listMonths =  explode(" b", $listMonths);
    // С помощью цикла и функции trim() убираем перенос строки и лишний пробелы
    foreach ($listMonths as$k=> $V) {
        $listMonths[$k]=trim($V);
    }
    $listMonths[] = $path;
    return $listMonths ;
}

// Определяем какой месяц сейчас с помощью системы линукс
function parsingMonths($nameMonths) {
    // Получили информацию про юзера и компьютер (там есть какой сейчас месяц)
    $path = shell_exec('uname -a') ;
    // Заменяем пробел на символ
    $infoUser = str_replace(' ', ' _ ', $path);
    // Разбиваем строку на массив по символу
    $infoUserArr =  explode(" _", $infoUser);
    // Убираем лишний пробелы в массиве
    foreach ($infoUserArr as $k=> $V) {
        $infoUserArr[$k]=trim($V);
    }
    // Прошлись по массиву технической информации и каждое слово (значение в этом массиве) подставили в наш поиск, когда слова совпадут
    // (если отдаст не пустой массив ) то мы получим в переменную значение
    foreach ($infoUserArr as $v2) {
        $key = array_keys($nameMonths, $v2);
        if (!empty($key)) {
            $nowMonth = $key;
        }
    }
    // подставляем ключ в массив и понимаем какой месяц сейчас
    $nowMonth = $nameMonths[$nowMonth[0]];
    return $nowMonth;
}

// Узнаем какой день месяца сейчас с помощью системы линукс
function day($nowMonth) {
    // Получили информацию про юзера и компьютер (там есть какой сейчас день)
    $path = shell_exec('uname -a') ;
    // Разбиваем строку на массив по разделителю (разделитель у нас месяц)
    $pathArr = explode($nowMonth , $path);
    // нам нужны первые три символа это будет наш день (первый символ пробел)
    $pathDay = substr($pathArr[1], 0, 3);
    // Прибавляем единицу, так как нам нужно завтра и это переводит строку в int
    $pathTomorow = 1 + $pathDay;
    return $pathTomorow;
}
?>
<p><a href="/">Вернутся назад</a></p>
