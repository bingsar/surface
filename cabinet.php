<?php

require_once 'functions.php';



if (!isAuthorized()) {
    header('Location: index.php');
    die;
}

if (!empty($_POST['campaign-name'])) {
    if (newCampaign($_POST['price_cpm'], $_POST['campaign-name'], $_POST['time-value'], $_POST['campaign-region'], $_POST['placement-type'])) {
        header('Location: cabinet.php');
        die;
    } else {
        $errors[] = 'Не хватает данных для создания кампании';
    }
}

if (isset($_FILES) && $_FILES['filename']['error'] == 0) {
    global $today;
    $fileName = $_SESSION['user_id'] . $today;
    $destinationDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'users'. DIRECTORY_SEPARATOR . $_SESSION['user_id'] . DIRECTORY_SEPARATOR .  'files' . DIRECTORY_SEPARATOR . $fileName;
    move_uploaded_file($_FILES['filename']['tmp_name'], $destinationDir);
} else {
    echo 'Не получилось загрузить файл';
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

    <title>Surface - Личный кабинет <?php print $_SESSION['user_email']; ?></title>

    <!-- Font Awesome -->
    <link href="/fontawesome/css/all.css" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <!-- САЙДБАР С МЕНЮ  -->
    <nav id="sidebar" class="mCustomScrollbar _mCS_1 mCS-autoHide" style="overflow: visible;">
        <div class="sidebar-header">
            <h3 style="font-family: 'Exo 2', sans-serif; font-weight: bolder"><img src="img/logo-small-white.png" height="29" width="41"> surface</h3>
        </div>
<br>
        <div class="nav flex-column nav-pills btn-group-vertical text-light" style="padding-left: 20px; padding-right: 20px" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link btn btn-outline-light text-left" id="v-pills-home-tab" style="background-color: #7386D5" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Трафик</a>
            <a class="nav-link btn btn-outline-light text-left" id="v-pills-profile-tab" style="background-color: #7386D5" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Кампании</a>
            <a class="nav-link btn btn-outline-light text-left" id="v-pills-messages-tab" style="background-color: #7386D5" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Площадки</a>
            <a class="nav-link btn btn-outline-light text-left" id="v-pills-settings-tab" style="background-color: #7386D5" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Медиафайлы</a>
            <a class="nav-link btn btn-outline-light text-left" id="v-pills-conversion-tab" style="background-color: #7386D5" data-toggle="pill" href="#v-pills-conversion" role="tab" aria-controls="v-pills-conversion" aria-selected="false">Конверсии</a>
        </div>
        <br>
        <br>
        <br>
        <a class="btn btn-outline-light text-left" style="margin-left: 20px; width: 84%" id="v-pills-conversion-tab" style="background-color: #7386D5" data-toggle="pill" href="#v-pills-conversion" role="tab" aria-controls="v-pills-conversion" aria-selected="false">Настройки <i class="fa fa-cog" style="float: right; margin-top: 5px" aria-hidden="true"></i></a>
        <br>
        <hr>
        <button class="btn btn-outline-light text-left" style="margin-left: 20px; width: 84%" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Ваш менеджер <i class="fa fa-id-badge" style="float: right; margin-top: 5px" aria-hidden="true"></i>
        </button>
        <div class="collapse text-light" id="collapseExample" style="margin-left: 20px; width: 84%">
            <div class="card card-body" style="background-color: transparent; margin-top: 10px">
                <p class="card-text text-light"><small>Петров Иван<br>
                Skype: live:ivan.surface<br>
                Email: ivan@surface.ads<br>
                        Тел: 8 (800) 955 33 10</small></p>
            </div>
    </nav>
    <!-- /САЙДБАР С МЕНЮ  -->
    <!-- СТРАНИЦА КАБИНЕТА  -->
    <div id="content">
        <!-- Верхнее основное меню  -->
        <nav class="navbar nav-pad navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fa fa-align-left" aria-hidden="true"></i> Меню
                </button>

                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
                    <div class="btn-group ml-auto">



                        <button type="button" class="btn text-light rounded" style="background-color: #17A2B8;" data-toggle="dropdown">
                            <i class="fa fa-user-circle" aria-hidden="true"></i> <?php print $_SESSION['user_email']; ?>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Профиль</a>
                            <a class="dropdown-item" href="#">Пополнить</a>
                            <a class="dropdown-item" href="#">Поддержка</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">Выйти</a>
                        </div>
                    </div>
                 </div>
            </div>
        </nav>
        <!-- Верхнее основное меню  -->


        <div class="tab-content" id="v-pills-tabContent">


            <!-- ТРАФИК СТРАНИЦА КАБИНЕТА -->
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                <!-- Кнопка вызова создания рекламной кампании -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="background-color: #17A2B8"><i class="fa fa-plus-square" aria-hidden="true"></i> Создать рекламную кампанию</button>
                <!-- Кнопка вызова создания рекламной кампании -->

                <!-- Создание рекламной кампании -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Создание рекламной кампании</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="cabinet.php" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="campaign-name" class="col-sm-3 col-form-label">Название</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="campaign-name" required class="form-control" id="campaign-name" placeholder="Название кампании">
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="timeTable" class="col-sm-3 col-form-label">Временной таргетинг</label>
                                        <div class="col-sm-9">

                                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#timeTable" aria-expanded="false" aria-controls="collapseExample">
                                                Изменить
                                            </button>

                                            <div class="collapse" id="timeTable">
                                                <div class="card card-body" style="margin-top: 20px">
                                                    <div class="table-responsive">
                                                        <table class="table-sm  table-hover-cells">
                                                            <tr>
                                                                <td>Время/<br>Дни недели</td>
                                                                <td>01<br>02</td>
                                                                <td>02<br>03</td>
                                                                <td>03<br>04</td>
                                                                <td>04<br>05</td>
                                                                <td>05<br>06</td>
                                                                <td>06<br>07</td>
                                                                <td>07<br>08</td>
                                                                <td>08<br>09</td>
                                                                <td>09<br>10</td>
                                                                <td>10<br>11</td>
                                                                <td>11<br>12</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Понедельник</td>
                                                                <td><input type="checkbox" name="time-value[]" value="mo-01-02"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="mo-02-03"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="mo-03-04"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="mo-04-05"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="mo-05-06"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="mo-06-07"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="mo-07-08"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="mo-08-09"></td>
                                                                    <td><input type="checkbox" name="time-value[]" value="mo-09-10"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="mo-10-11"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="mo-11-12"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Вторник</td>
                                                                <td><input type="checkbox" name="time-value[]" value="tu-01-02"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="tu-02-03"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="tu-03-04"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="tu-04-05"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="tu-05-06"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="tu-06-07"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="tu-07-08"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="tu-08-09"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="tu-09-10"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="tu-10-11"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="tu-11-12"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Среда</td>
                                                                <td><input type="checkbox" name="time-value[]" value="we-01-02"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="we-02-03"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="we-03-04"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="we-04-05"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="we-05-06"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="we-06-07"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="we-07-08"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="we-08-09"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="we-09-10"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="we-10-11"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="we-11-12"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Чеверг</td>
                                                                <td><input type="checkbox" name="time-value[]" value="th-01-02"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="th-02-03"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="th-03-04"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="th-04-05"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="th-05-06"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="th-06-07"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="th-07-08"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="th-08-09"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="th-09-10"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="th-10-11"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="th-11-12"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Пятница</td>
                                                                <td><input type="checkbox" name="time-value[]" value="fr-01-02"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="fr-02-03"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="fr-03-04"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="fr-04-05"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="fr-05-06"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="fr-06-07"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="fr-07-08"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="fr-08-09"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="fr-09-10"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="fr-10-11"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="fr-11-12"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Суббота</td>
                                                                <td><input type="checkbox" name="time-value[]" value="sa-01-02"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="sa-02-03"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="sa-03-04"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="sa-04-05"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="sa-05-06"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="sa-06-07"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="sa-07-08"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="sa-08-09"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="sa-09-10"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="sa-10-11"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="sa-11-12"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Воскресенье</td>
                                                                <td><input type="checkbox" name="time-value[]" value="su-01-02"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="su-02-03"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="su-03-04"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="su-04-05"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="su-05-06"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="su-06-07"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="su-07-08"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="su-08-09"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="su-09-10"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="su-10-11"></td>
                                                                <td><input type="checkbox" name="time-value[]" value="su-11-12"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Выбор региона показа</label>
                                        <div class="col-sm-9">
                                            <select name="campaign-region[]" class="selectpicker form-control" multiple required data-actions-box="true" data-size="5">
                                               <?php foreach (getCity() as $city) { ?>
                                                <option value="<?= $city['city'] ?>"><?= $city['city'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Загрузка креатива</label>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" name="filename" class="custom-file-input" id="customFileLangHTML">
                                                <label class="custom-file-label" for="customFileLangHTML" data-browse="Обзор">Выберите файл</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Типы площадок</label>
                                        <div class="col-sm-9">
                                            <select name="placement-type[]" class="selectpicker form-control" multiple required data-actions-box="true" data-size="5">

                                                <?php foreach (getPlaceCategory() as $category) { ?>
                                                    <option value="<?= $category['categoryName'] ?>"><?= $category['categoryName'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="price_cpm">Цена CPM, руб.</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="price_cpm" class="form-control" required id="price_cpm" placeholder="Максимальная цена за 1000 показов">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Создание рекламной кампании -->


                <br>


                <!-- Таблица отчетов по категориям -->
                <ul class="nav nav-pills mb-3 navbar-light"  style="margin-top: 10px" id="pills-tab" role="tablist">
                    <span class="lead" style="margin-top: 4px">Трафик:</span> &nbsp;&nbsp;&nbsp;
                    <li class="nav-item">
                        <a class="nav-link active" id="company-filter-tab" data-toggle="pill" href="#company-filter" role="tab" aria-controls="company-filter" aria-selected="true">По кампаниям</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="placement-filter-tab" data-toggle="pill" href="#placement-filter" role="tab" aria-controls="placement-filter" aria-selected="false">По площадкам</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="region-filter-tab" data-toggle="pill" href="#region-filter" role="tab" aria-controls="region-filter" aria-selected="false">По регионам</a>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="company-filter" role="tabpanel" aria-labelledby="company-filter-tab">
                        <h4 class="display-4">Кампании</h4>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Название</th>
                                <th scope="col">Показы</th>
                                <th scope="col">Охват</th>
                                <th scope="col">Средняя цена за показ, руб.</th>
                                <th scope="col">Расходы всего, руб.</th>
                                <th scope="col">Статус</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">100057</th>
                                <td>ТЦ-Плаза-SPB</td>
                                <td>1 451 209</td>
                                <td>10 257 098</td>
                                <td>1,14</td>
                                <td>1262551,83</td>
                                <td>Идут показы</td>
                            </tr>
                            <tr>
                                <th scope="row">100091</th>
                                <td>ТЦ-Европолис-SPB</td>
                                <td>342 121</td>
                                <td>2 043 791</td>
                                <td>1,10</td>
                                <td>309277,38</td>
                                <td>Идут показы</td>
                            </tr>
                            <tr>
                                <th scope="row">100108</th>
                                <td>ТЦ-Меркурий-SPB</td>
                                <td>3 950 144</td>
                                <td>25 783 113</td>
                                <td>1,42</td>
                                <td>2765100,80</td>
                                <td>Приостановлена</td>
                            </tr>
                            </tbody>
                        </table>


                    </div>
                    <div class="tab-pane fade" id="placement-filter" role="tabpanel" aria-labelledby="placement-filter-tab">Фильтр по рекламным местам</div>
                    <div class="tab-pane fade" id="region-filter" role="tabpanel" aria-labelledby="region-filter-tab">Фильтр по регионам</div>
                </div>
                <!-- Таблица отчетов по категориям -->


            </div>
            <!-- /ТРАФИК СТРАНИЦА КАБИНЕТА -->


            <!-- КАМПАНИИ СТРАНИЦА КАБИНЕТА -->
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <h2 class="text-justify">Мои Кампании</h2>

                <table class="table table-hover small">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Название кампании</th>
                        <th scope="col">Города показов</th>
                        <th scope="col">Цена CPM, руб.</th>
                        <th scope="col">Типы площадок</th>
                        <th scope="col">Статус</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach (getCampaignIdNameCPM($_SESSION['user_id']) as $campaignId) { ?>
                    <tr>
                        <th scope="row"><?= $campaignId['campaign_id']; ?></th>
                        <td><?= $campaignId['campaign_name']; ?></td>
                        <td>
                            <span id="inTableCampaignCity<?= $campaignId['campaign_name']; ?>" style="display: inline-block;"><?= $campaignId['group_concat(DISTINCT campaign_city)']; ?></span>

                            <form id="formInputNewCity<?= $campaignId['campaign_name']; ?>" style="display: none;">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <select name="campaign-region-change[]" multiple required data-actions-box="true" data-size="2">
                                            <?php foreach (getCity() as $city) { ?>
                                                <option value="<?= $city['city'] ?>"><?= $city['city'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" id="applyButton<?= $campaignId['campaign_name']; ?>" class="btn btn-link btn-sm" title="Редактировать" style="display: none" onclick="displayForm(document.getElementById('formInputNewCity<?= $campaignId['campaign_name']; ?>'), document.getElementById('inTableCampaignCity<?= $campaignId['campaign_name']; ?>')), displayButton(document.getElementById('editButton<?= $campaignId['campaign_name']; ?>'), document.getElementById('applyButton<?= $campaignId['campaign_name']; ?>'), document.getElementById('cancelButton<?= $campaignId['campaign_name']; ?>'))">
                                    <i class="far fa-check-square"></i>
                                </button>
                                <script>

                                    $(function(){
                                        $(document).on("click","applyButton<?= $campaignId['campaign_name']; ?>",function() {
                                            var value = $(this).val();
                                            $.ajax( {
                                                type: 'get',
                                                url: "function.php",
                                                data: {
                                                    auto_value :
                                                },
                                                success: function (response) {

                                                }
                                            });
                                        });
                                    });

                                </script>
                            </form>

                            <button type="button" id="editButton<?= $campaignId['campaign_name']; ?>" class="btn btn-link btn-sm" title="Редактировать" style="display: inline-block" onclick="displayForm(document.getElementById('formInputNewCity<?= $campaignId['campaign_name']; ?>'), document.getElementById('inTableCampaignCity<?= $campaignId['campaign_name']; ?>')), displayButton(document.getElementById('editButton<?= $campaignId['campaign_name']; ?>'), document.getElementById('applyButton<?= $campaignId['campaign_name']; ?>'), document.getElementById('cancelButton<?= $campaignId['campaign_name']; ?>'))">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button type="button" id="cancelButton<?= $campaignId['campaign_name']; ?>" class="btn btn-link btn-sm" title="Редактировать" style="display: none" onclick="displayForm(document.getElementById('formInputNewCity<?= $campaignId['campaign_name']; ?>'), document.getElementById('inTableCampaignCity<?= $campaignId['campaign_name']; ?>')), displayButton(document.getElementById('editButton<?= $campaignId['campaign_name']; ?>'), document.getElementById('applyButton<?= $campaignId['campaign_name']; ?>'), document.getElementById('cancelButton<?= $campaignId['campaign_name']; ?>'))">
                                <i class="far fa-window-close"></i>
                            </button>



                        </td>
                        <td><?= $campaignId['campaign_cpm']; ?></td>
                        <td><?= $campaignId['group_concat(DISTINCT campaign_placement_type)']; ?></td>
                        <td>В ожидании модерации</td>
                    </tr>
                    <? } ?>
                    </tbody>
                </table>
            </div>
            <!-- /КАМПАНИИ СТРАНИЦА КАБИНЕТА -->


            <!-- ВЛАДЕЛЕЦ РЕКЛАМНЫХ МЕСТ СТРАНИЦА КАБИНЕТА -->
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                <h1>Владелец рекламных мест</h1>

            </div>
            <!-- /ВЛАДЕЛЕЦ РЕКЛАМНЫХ МЕСТ СТРАНИЦА КАБИНЕТА -->


            <!-- МЕДИАФАЙЛЫ СТРАНИЦА КАБИНЕТА -->
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <h2>Контакты </h2>
                <p class="text-justify">Мы прямо сейчас в поисках хороших разработчиков. Если вы увлеченный работник и думаете, что у вас есть то, что нужно, отправьте свое резюме и подробную информацию на jobs@surface.ads</p>
                <p class="text-justify">ООО "Сюрфэйс"<br>195297, Санкт-Петербург, Светлановский пр.70</p>
                <p class="text-justify">hello@surface.ads</p>
                <h4>Пишите, не стесняйтесь</h4>
            </div>
            <!-- /МЕДИАФАЙЛЫ СТРАНИЦА КАБИНЕТА -->


            <!-- КОНВЕРСИИ СТРАНИЦА КАБИНЕТА -->
            <div class="tab-pane fade" id="v-pills-conversion" role="tabpanel" aria-labelledby="v-pills-conversion-tab">
                <h2>Контакты </h2>
                <p class="text-justify">Мы прямо сейчас в поисках хороших разработчиков. Если вы увлеченный работник и думаете, что у вас есть то, что нужно, отправьте свое резюме и подробную информацию на jobs@surface.ads</p>
                <p class="text-justify">ООО "Сюрфэйс"<br>195297, Санкт-Петербург, Светлановский пр.70</p>
                <p class="text-justify">hello@surface.ads</p>
                <h4>Пишите, не стесняйтесь</h4>
            </div>
            <!-- /КОНВЕРСИИ СТРАНИЦА КАБИНЕТА -->
        </div>
        <!-- /СТРАНИЦА КАБИНЕТА-->
    </div>
</div>


<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="/bootstrap-4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- Latest compiled and minified JavaScript SELECT -->
<script src="/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css">
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="/bootstrap-select-1.13.9/dist/js/i18n/defaults-*.min.js"></script>
<!-- bs-custom-file-input -->
<script src="/bootstrap-4.0.0/node_modules/bs-custom-file-input/dist/bs-custom-file-input.js"></script>

<script>
    bsCustomFileInput.init()
    var btn = document.getElementById('btnResetForm')
    var form = document.querySelector('form')
    btn.addEventListener('click', function () {
        form.reset()
    })
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar, #content').toggleClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
</script>
<script>
    function displayForm(formNewCity, spanCity) {
        if (formNewCity.style.display == "none") {
            formNewCity.style.display = "inline-block";
            spanCity.style.display = "none";
        } else {
            formNewCity.style.display = "none";
            spanCity.style.display = "inline-block";
        }
    }
    function displayButton(button, buttonApply, buttonCancel) {
        if (button.style.display == "inline-block") {
            button.style.display = "none";
            buttonApply.style.display = "inline-block";
            buttonCancel.style.display = "inline-block";
        } else {
            button.style.display = "inline-block";
            buttonApply.style.display = "none";
            buttonCancel.style.display = "none";
        }
    }
</script>
</body>
</html>