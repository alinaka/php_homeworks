<?php
//Задания к 3.05.2018 (четверг):

//1. Вывести таблицу умножения чисел до 10 с помощью двух циклов for (вложенный цикл);
?>
<table> 
<?php
for ($i = 1; $i <=10; $i++) {
    echo "<tr>";
    for($j = 1; $j <= 10; $j++) {
        echo "<td style='border: 1px solid black'>" . $i * $j . "</td>";
    }
    echo "</tr>";
}
?>
</table>

<?php
/*
2. Нарисуйте треугольник (или ромб) из символов *. 
Высота треугольника равна 15.*/

for ($x = 1; $x <= 15; $x++) {
    echo str_repeat("*", $x)  . "<br>";
}

echo "<pre>";
for ($x = 1; $x <= 7; $x++) {
    echo str_repeat(' ', (8 - $x)) . str_repeat('*', $x * 2 -1). "<br>";
}
for ($x = 8; $x > 0; $x--) {
    echo str_repeat(' ', (8 - $x)) . str_repeat('*', $x * 2 - 1). "<br>";
}
echo "</pre>";
echo "<br>";

/*3. Создать массив из дней недели. С помощью цикла foreach выведите все дни недели, 
а текущий день выведите жирным. Текущий день можно получить с помощью функции date.
Название дней выводить по-русски */

$week = ['понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье'];
$day_num = (int) date("w");

foreach ($week as $day) {
    switch($day) {
        case $week[$day_num - 1]:
            echo "<b>" . $week[$day_num - 1] . "</b>" . " ";
            break;
        default: 
            echo $day . " ";
    }
};
echo "<br>";

//4. Отсортировать массив по 'price'
$arr = [
'1'=> [
'price' => 10,
'count' => 2
],
'2'=> [
'price' => 5,
'count' => 5
],
'3'=> [
'price' => 8,
'count' => 5
],
'4'=> [
'price' => 12,
'count' => 4
],
'5'=> [
'price' => 8,
'count' => 4
],
];

asort($arr);
print_r($arr);
echo "<br>";

/*
5. Дан массив $fruits. 
Каждому вложенному массиву добавить count - количество элементов в массиве (элементы с одинаковым name)
Удалить дублирующиеся элементы
*/
$fruits = [
[
"name"=> "apple",
"color"=> "red", 
],
[
"name"=> "orange",
"color"=> "orange",
],
[
"name"=> "lemon",
"color"=> "yellow",
],
[
"name"=> "apple",
"color"=> "green",
],
[
"name"=> "plum",
"color"=> "violet",
],
[
"name"=> "plum",
"color"=> "violet",
],
[
"name"=> "apple",
"color"=> "red",
],
[
"name"=> "lemon",
"color"=> "yellow",
],
[
"name"=> "banana",
"color"=> "yellow",
]
];


$names = [];
foreach ($fruits as $fruit) {
    array_push($names, $fruit["name"]);
};
$names = array_count_values($names);

foreach ($fruits as &$fruit) {
    $fruit["count"] = $names[$fruit["name"]];
};

$temp_array = []; 
$key_array = []; 
    
foreach($fruits as &$fruit) { 
    if (!in_array($fruit["name"], $key_array)) { 
        $key_array[] = $fruit["name"]; 
        $temp_array[] = $fruit; 
    } 
};
unset($fruit);
    
print_r($temp_array);
echo "<br>";

/*6. В городе N проезд в трамвае осуществляется по бумажным отрывным билетам. 
Каждую неделю трамвайное депо заказывает в местной типографии 
рулон билетов с номерами от 000001 до 999999. 
«Счастливым» считается билетик у которого сумма первых трёх цифр номера 
равна сумме последних трёх цифр, как, например, в билетах с номерами 003102 или 567576. 
Трамвайное депо решило подарить сувенир обладателю каждого счастливого билета 
и теперь раздумывает, как много сувениров потребуется. 
Подсчитайте сколько счастливых билетов в одном рулоне (информацию на экран).*/
$happy_tickets = 0;
for($i = 1; $i <= 999; $i++) {
    for($j = 0; $j <=999; $j++) {
        $sum_i = ($i % 10) + (($i - $i % 10) % 100 / 10) + (($i - $i % 100) / 100);
        $sum_j = ($j % 10) + (($j - $j % 10) % 100 / 10) + (($j - $j % 100) / 100);
        if($sum_i == $sum_j) {
            $happy_tickets ++;
        }
    }
}
echo "Всего счастливых билетов: " . $happy_tickets . "<br>";

/*
Маленькие задачи на функции работы с массивами:

7.Создайте массив, заполненный буквами от 'a' до 'j'. 
Сделайте из него массив с заглавными буквами. 
*/
$range_arr = range('a','j');
$range_arr_upper = array_map ('strtoupper',$range_arr);
print_r ($range_arr_upper);
echo "<br>";

/*8. Создать массив, заполненный цифрами от '1' до '10'. 
Найдите сумму элементов данного массива
Найдите произведение элементов данного массива
Выведите на экран его элементы в следующем порядке: 
1102837465.*/

$a = range(1,10);
$sum_a = array_sum($a);
$product_a = array_product($a);
echo $sum_a . "<br>" . $product_a . "<br>";

//9. Создайте массив ['a'=>1, 'b'=2... 'j'=>10] из предыдущих массивов.
$new_array = array_combine($range_arr, $a);
print_r($new_array);
echo "<br>";

//10. Создайте массив вида [[1, 2, 3], [4, 5, 6], [7, 8, 9]] (цикл не использовать). 
$newARR = array_chunk(range(1,9), 3);
print_r($newARR);
echo "<br>";

/*11. Дан массив с элементами ['<p>Some</p>', '<p>info</p>']. 
Создайте новый массив, в котором из элементов будут удалены теги.*/
$array_with_tags =['<p>Some</p>', '<p>info</p>']; 
$array_no_tags = array_map ('strip_tags', $array_with_tags);
print_r ($array_no_tags);

?>