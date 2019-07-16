<?php

require_once 'functions.php';

$errors = [];

global $thetime;

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    if (authorization($_POST['email'], $_POST['password'])) {
        header('Location: /cabinet.php');
        die;
    } else {
        $errors[] = 'Неверный логин или пароль';
    }
}

if (!empty($_POST['new_email'])) {
    if (checkExistedEmail($_POST['new_email'])) {
        header("location: cabinet.php");
        die;
    } else {
        $errorsLogin[] = 'Такой Email уже существует';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/bootstrap-4.0.0/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/bootstrap-4.0.0/dist/css/mine.css">
    <link rel="stylesheet" href="/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css">

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Exo+2|Philosopher" rel="stylesheet">

    <title>Surface - управляй наружной цифровой рекламой</title>
    <style>
        h3 {
            font-family: 'Exo 2', sans-serif;
        }
    </style>
</head>
<body>

<header>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="index.php"><img src="img/logo.png" height="31"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#about">О нас <span class="sr-only">О нас</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#advertisers">Рекламодателям</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#placeholders">Площадкам</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#agency">Агенствам</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contacts">Контакты</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <span class="em"><?php echo $thetimeyear ?> &nbsp; </span>
                <input class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 type="submit">Найти</button>
            </form>
        </div>
    </nav>
</header>
<!-- Main navigation -->
<!--Main Layout -->
<main>
    <div class="view" style="background: linear-gradient(0deg, #FFFFFF, #E3F2FD)">
        <div class="container">
            <!--Grid row-->
            <div class="row py-5">
                <!--Grid column-->
                <div class="col-md-8 text-center">
                    <h3 class="text-success">Управляй наружной цифровой рекламой</h3>
                    <div>
                        <br>
                        <img src="img/rule-the-ads-main-screen.png" class="img-fluid" alt="Responsive image">
                    </div>
                    <br>
                    <div>
                    <h3 class="text-success" style="margin-left: 10%; margin-right: 10%">
                        Платформа Surface позволяет управлять цифровой indoor и outdoor рекламой прямо из дома или офиса.
                    </h3>
                    </div>
                </div>
                <div class="col-md-4 border-left border-primary">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-login-tab" data-toggle="tab" href="#nav-login" role="tab" aria-controls="nav-login" aria-selected="true">Войти</a>
                            <a class="nav-item nav-link" id="nav-register-tab" data-toggle="tab" href="#nav-register" role="tab" aria-controls="nav-register" aria-selected="false">Регистрация</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <!--ВХОД-->
                        <div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab">

                                <form method="POST" class="px-4 py-3">
                                    <ul>
                                        <?php foreach ($errors as $error): ?>
                                            <li><?= $error ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <ul>
                                        <?php if (isset($errorsLogin)) { foreach ($errorsLogin as $errorer): ?>
                                            <li><?= $errorer ?></li>
                                        <?php endforeach; } ?>
                                    </ul>
                                    <div class="form-group">
                                        <label for="email">Введите email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="email@example.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Введите пароль</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Пароль">
                                    </div>
                                    <div class="form-check custom-control custom-checkbox">
                                        <input type="checkbox" name="rememberMeCheck" class="custom-control-input" id="rememberMeCheck">
                                        <label class="custom-control-label" for="rememberMeCheck">
                                            Запомните меня
                                        </label>
                                    </div>

                                    <br>
                                    <button type="submit" class="btn btn-primary">Войти</button>
                                </form>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Забыли пароль?</a>

                        </div>
                        <!--/ВХОД-->

                        <!--РЕГИСТРАЦИЯ-->
                        <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab">

                            <form method="POST" class="px-4 py-3">
                                <label for="user_name">Введите ваше Имя и Фамилию</label>
                                <div class="row">

                                    <div class="col">
                                        <input type="text" name="name" id="user_name" class="form-control" placeholder="Имя">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="surname" id="user_surname" class="form-control" placeholder="Фамилия">
                                    </div>
                                </div>
                                <div>
                                <label for="user_email">Введите ваш email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    </div>
                                    <input type="text" class="form-control" name="new_email" id="user_email" placeholder="Email" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Введите ваш email
                                    </div>

                                </div>
                                </div>

                                <div>
                                <label for="user_password">Введите ваш пароль</label>
                                <input type="password" name="new_password" id="user_password" class="form-control" aria-describedby="passwordHelpBlock" placeholder="Пароль">
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Должен быть не меньши 6 символов
                                </small>
                                </div><br>
                                <label>Выберите тип аккаунта</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="account_type" class="custom-control-input" value="Advertiser" id="adv">
                                    <label class="custom-control-label" for="adv">Рекламодатель</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="account_type" class="custom-control-input" value="Placeowner" id="plcw">
                                    <label class="custom-control-label" for="plcw">Владелец рекламного места</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="account_type" class="custom-control-input" value="Agency" id="ag">
                                    <label class="custom-control-label" for="ag">Агенство</label>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="user_comment">Ваш комментарий</label>
                                    <textarea class="form-control" name="comment" id="user_comment" rows="3"></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit">Отправить</button>
                            </form>

                        </div>
                        <!--/РЕГИСТРАЦИЯ-->
                    </div>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>
        <!--ABOUT SLIDE-->
        <div class="container">
            <h1 class="display-4" id="about">О нас</h1>
        </div>
        <div class="container">
            <div class="row py-5">
            <div class="nav flex-column nav-pills col-sm-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">О компании</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Возможности Surface</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Цель</a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Контакты</a>
            </div>
            <div class="tab-content col-sm-8" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <h2>О компании</h2>
                    <p class="text-justify">Команда Surface - это группа энтузиастов, программистов, UX/UI дизайнеров, frontend и backend разработчиков. Запуск платформы планируется к концу 2019 года. Проект находится в стадии тестирования. Команда имеет большой опыт в автоматизации бизнес процессов и надеется, что вам понравится её продукт. Основной упор сделан на интуитивно понятный и красивый интерфейс, а также на мощный и бесперебойный функционал. Мы хотим, чтобы вам приятно было работать с нами и будем рады любой обратной связи.</p>

                    <button type="button" class="btn btn-outline-success">Оставить нам сообщение</button>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <h2>Возможности Surface</h2>
                    <p class="justify-content">Веб-платформа Surface обеспечивает взаимодействие рекламодателей и рекламных мест. На веб-платформе присутствуют, как владельцы рекламных мест, так и рекламодатели.</p>
                    <h4 class="alert-heading">Возможности рекламодателя:</h4>
                    <div class="alert alert-success" role="alert">
                            <p class="mb-0">Создание рекламных кабинетов для разных клиентов</p>
                            <hr>
                            <p class="mb-0">Создание рекламных кампаний для разных направлений</p>
                            <hr>
                            <p class="mb-0">Выбор креативов из базы и загрузка своих собственных (баннеры, видео, анимация, call to action)</p>
                            <hr>
                            <p class="mb-0">Выбор рекламных площадок по категориям</p>
                            <hr>
                            <p class="mb-0">Выбор определенной локации на карте для показов</p>
                            <hr>
                            <p class="mb-0">Выбор оплаты за показы или за действия</p>
                            <hr>
                            <p class="mb-0">Сбор MAC-адресов для онлайн рекламы <span class="badge badge-danger">Горячая опция</span></p>
                            <hr>
                            <p class="mb-0">Выбор  аудиторий по категориям</p>
                            <hr>
                            <p class="mb-0">Ограничение дневного и месячного бюджета</p>
                            <hr>
                            <p class="mb-0">Защита от некачественных рекламных площадок <span class="badge badge-success">Защищено</span></p>
                            <hr>
                            <p class="mb-0">и еще +10 настроек для более таргетированной рекламы</p>
                        </div>
                    <h4 class="alert-heading">Возможности рекламной площадки:</h4>
                    <div class="alert alert-success" role="alert">
                        <p class="mb-0">Авторизация рекламного места</p>
                        <hr>
                        <p class="mb-0">Выбор разрешенных категорий показов</p>
                        <hr>
                        <p class="mb-0">Выбор разрешенного времени показа для каждого рекламного места</p>
                        <hr>
                        <p class="mb-0">Запрет на показ рекламы конкурентов</p>
                        <hr>
                        <p class="mb-0">Простое подключение</p>
                        <hr>
                        <p class="mb-0">Еженедельные выплаты</p>
                        <hr>
                        <p class="mb-0">Личный менеджер</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <h2 class="text-justify">Наша цель </h2>
                    <p class="text-justify"> Предоставить доступ любой компании владельцу мониторов к мировым или локальным рекламным бюджетам, вне зависимости от размера и географического расположения</p>
                    <h4 class="text-justify">Для этого мы планируем:</h4>
                    <div class="alert alert-success" role="alert">
                        <p class="mb-0">Сделать рынок цифровой рекламы прозрачным и конкурентным</p>
                        <hr>
                        <p class="mb-0">Применить последние инновационные технологии в оффлайн рекламе</p>
                        <hr>
                        <p class="mb-0">Предоставлять профиль площадки, местоположение, целевую аудиторию, проходимость, количество просмотров рекламы, прямые взаимодействия с услугой или товаром прямо с телефонов клиентов</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <h2>Контакты </h2>
                    <p class="text-justify">Мы прямо сейчас в поисках хороших разработчиков. Если вы увлеченный работник и думаете, что у вас есть то, что нужно, отправьте свое резюме и подробную информацию на jobs@surface.ads</p>
                    <p class="text-justify">ООО "Сюрфэйс"<br>195297, Санкт-Петербург, Светлановский пр.70</p>
                    <p class="text-justify">hello@surface.ads</p>
                    <h4>Пишите, не стесняйтесь</h4>
                </div>
            </div>
            </div>
        </div>
        <!--ABOUT SLIDE-->
        <!--ADVERTISERS SLIDE-->
        <div class="container">
            <h1 class="display-4" id="advertisers">Рекламодателям</h1>
<br>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card" style="margin: 5px 5px 5px 5px;">
                        <div class="card-body">
                            <img class="card-img-top" src="img/slide-img-aim-audience.png" alt="Точный таргетинг">
                            <h5 class="card-title">Точный таргетинг</h5>
                            <p class="card-text">Большой выбор площадок с разной ЦА. Собираем MAC-адреса</p>
                            <a href="#" class="btn btn-primary">Попробовать</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="margin: 5px 5px 5px 5px;">
                        <div class="card-body">
                            <img class="card-img-top" src="img/slide-img-settings.png" alt="Точная настройка">
                            <h5 class="card-title">Точная настройка</h5>
                            <p class="card-text">Разные рекламные материалы в зависимости от времени суток</p>
                            <a href="#" class="btn btn-primary">Попробовать</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="margin: 5px 5px 5px 5px;">
                        <div class="card-body">
                            <img class="card-img-top" src="img/slide-img-analytics.png" alt="Точная аналитика">
                            <h5 class="card-title">Точная аналитика</h5>
                            <p class="card-text">Отчеты по показам и просмотрам в реальном времени</p>
                            <a href="#" class="btn btn-primary">Попробовать</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
<br >
    <div class="container">
        <div class="row">

            <h3>
                Работа с рекламодателями
            </h3>

            <p class="text-justify">Для обеспечения безопасности и выполнения всех обязательств и условий мы обязаны авторизовать каждого рекламодателя. В случае несоблюдения правил оформления рекламы, мы имеем право останавливать рекламу. При этом не использованные средства будут возвращены, за вычетом комиссии за транзакции.</p>
        </div>
    </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="alert alert-primary" role="alert">
                        <h4 class="alert-heading">Рекламная модель CPA</h4>
                        <p class="lead">Оплата за действие. Вам предлагается несколько вариантов возможных действий, которые должен сделать клиент</p>
                        <hr>
                        <p class="mb-0">Переход по уникальной ссылке (например, для просмотра лэндинга). Деньги с рекламодателя будут списаны в случае, если клиент перешел по ссылке. Ссылка генерируется системой. Каждый переход с уникального IP-адреса будет засчитан.</p>
                        <hr>
                        <p class="mb-0">Переход по неуникальной ссылке и дальнейшее действие на сайте. В этом случае само действие стоит дороже. К действию должен быть привязан идентификатор, который сообщит в случае удачного выполнения цели. Например, покупка билета на концерт или регистрация. Система сохраняет MAC-адрес устройства и в дальнейшем при отложенной конверсии также засчитывает действие.</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="alert alert-primary" role="alert">
                        <h4 class="alert-heading">Рекламная модель CPM</h4>
                        <p class="lead">Оплата за 1000 показов на выбранных площадках</p>
                        <hr>
                        <p class="mb-0">Вы настраиваете таргетированную рекламу, после подтверждения модератора реклама запускается и у вас начинают списываться деньги за каждые 1000 показов. Стоимость показов существенно ниже, чем при оплате за действие (CPA)</p>
                    </div>
                </div>
        </div>
    </div>
        <!--ADVERTISERS SLIDE-->
        <!--PLACEHOLDERS SLIDE-->
    <div class="container">
        <div class="row">
            <h1 class="display-4" id="placeholders">Площадкам</h1>
        </div>
        <br>
        <div class="col-sm-12">

            <div class="jumbotron">
                <h1 class="display-4 text-center">Добро пожаловать!</h1>
                <br><br>
                <img src="img/lcd-panels.gif" class="img-fluid mx-auto d-block rounded" alt="Responsive image">
                <br>
                <p class="lead">Нам очень важно развивать качественную рекламную сеть, где будут представлены различные типы рекламных площадок.</p>
                <p class="lead">Мы собрали в себе лучшие инструменты для показа рекламы на ваших устройствах. Мы гарантируем качественный контент и автоматизированные выплаты без задержек.</p>
                <hr class="my-4">
                <p>Мы будем очень рады познакомиться с вами. Заполните небольшую анкету и мы оперативно свяжемся с вами.</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Заполнить</a>
                </p>
                <p>Вы также можете приступить к <a href="#">регистрации</a> самостоятельно.</p>
            </div>
            </div>
    </div>
        <!--PLACEHOLDERS SLIDE-->
        <!--AGENCY SLIDE-->

        <div class="container">
            <div class="row">
                <h1 class="display-4" id="agency">Агенствам</h1>
            </div>
            <br>
            <div class="col-sm-12">


                    <h1 class="display-4 text-center">Найдем общий язык!</h1>
                    <br><br>
                    <img src="img/animals-slide.png" class="img-fluid mx-auto d-block rounded" alt="Responsive image">
                    <br>
            </div>
            <div class="row align-items-center">
            <div class="col-sm-8">
                    <p class="lead">У вас может не быть монитора в людном месте или продукта, который вы хотите продвигать, но вы хотите заработать?</p>
                    <p class="lead">Мы предлагаем выгодные условия агентам, которые занимаются подключением мониторов к сети, а также скидки на рекламу.</p>
            </div>
            <div class="col-sm-4">
                <button type="button" class="btn btn-success">Заполнить анкету агента</button>
            </div>
            </div>
        </div>
        <br>
        <!--AGENCY SLIDE-->
        <!--FOOTER-->

        <div class="card-group">
            <div class="card bg-light">
                <div class="card-body">
                    <i class="fa fa-facebook fa-2x" aria-hidden="true" style="margin-right: 5px"></i>
                    <i class="fa fa-instagram fa-2x" aria-hidden="true" style="margin-right: 5px"></i>
                    <i class="fa fa-vk fa-2x" aria-hidden="true" style="margin-right: 5px"></i>
                    <i class="fa fa-youtube-play fa-2x" aria-hidden="true" style="margin-right: 5px"></i>
                </div>
            </div>
            <div class="card bg-light">
                <div class="card-body">
                    <h5>Меню</h5>
                    <a href="#about">О нас</a><br>
                    <a href="#advertisers">Рекламодателям</a><br>
                    <a href="#placeholders">Площадкам</a><br>
                    <a href="#agency">Агенствам</a><br>
                    <a href="#contacts">Контакты</a><br>
                </div>
            </div>
            <div class="card bg-light">
                <div class="card-body">
                    <p class="card-text">Платформа для взаимодействия рекламодателей и рекламных площадок.</p>
                    <p class="card-text"><small class="text-muted">Все права защищены. The Surface Inc. 2019</small></p>
                </div>
            </div>
        </div> 

        <!--FOOTER-->
    </div>
</main>
<!--Main Layout-->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="/bootstrap-4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript SELECT -->
<script src="/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://use.fontawesome.com/69ff9d7ec6.js"></script>
</body>
</html>