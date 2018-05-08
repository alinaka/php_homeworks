<?php
$data = [
    [
        'id' => 1,
        'title' => 'Отредактировать тестовое задание',
        'content' => 'Переделать по новому макету',
    ],
    [
        'id' => 2,
        'title' => 'Сделать домашку по PHP',
        'content' => 'Вывод данных из массива в html, исходя из логики дипломного проекта;
                        Валидация формы на стороне клиента;
                        Получение данных форма на сервере.',
    ],
    [
        'id' => 3,
        'title' => 'Title3',
        'content' => 'content3',
    ],
    [
        'id' => 4,
        'title' => 'Title4',
        'content' => 'content4',
    ],
];
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <p>LOGO</p>
        </header>
        <aside class="aside_nav">
            <div class="aside_nav__item">Задачи</div>
            <div class="aside_nav__item">Проекты</div>
            <div class="aside_nav__item">Клиенты</div>
            <div class="aside_nav__item">Сообщения</div>
            <div class="aside_nav__item">Календарь</div>
        </aside>
        <section class="section">
            <h3>Мои задачи</h3>
            <?php foreach($data as $item): ?>
            <div>
                <h4><?php echo $item['title']?></h4>
                <p><?php echo $item['content']?></p>
                <a href="data.php?id=<?php echo $item['id']?>">Подробнее</a>
            </div>
            <?php endforeach; ?>
        </section>
        <footer class="footer">
        </footer>
    </div>
</body>
</html>
