<?php

setlocale(LC_ALL, 'russian');

session_start();

$db = 'surface';
$user = 'root';
$pass = '';
$host = 'localhost';
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
$thetimeyear = date('d F' , time());
$thetime = date('Y-m-d H:i:s' , time());
$today = date('jnyGis');

if (isset($_GET)) {
    if ($_GET['auto_value'] == 1) {
        $text = "button 1 clicked";
    } else if ($_GET['auto_value'] == 2) {
        $text = "second button clicked";
    }
}

function authorization($email, $password)
{
    global $pdo;
    $authorization = 'SELECT * FROM user WHERE email = :email AND password = :password';
    $stmt = $pdo->prepare($authorization);
    $stmt->execute(["email" => "$email", "password" => "$password"]);
    $users = $stmt->fetchAll();
    foreach ($users as $user) {
        if (isset($user)) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $user['email'];
            return true;
        } else {
            return false;
        }

    }
}

function checkExistedEmail($email)
{
    global $pdo;
    $checkExistedEmail = 'SELECT email FROM user WHERE email = ?';
    $stmt = $pdo->prepare($checkExistedEmail);
    $stmt->execute(["$email"]);
    $emails = $stmt->fetchAll();
    foreach ($emails as $email) {
        if (isset($email)) {
            return false;
        }
    }
    if (empty($emails)) {
        addUser();
        return true;
    }
}

function addUser()
{
    global $pdo;
    $user_name = $_POST['name'];
    $user_surname = $_POST['surname'];
    $email = $_POST['new_email'];
    $password = $_POST['new_password'];
    $account_type = $_POST['account_type'];
    $comment = $_POST['comment'];
    $addUser = 'INSERT INTO user(name, surname, email, password, account_type, comment) VALUES (:name, :surname, :email, :password, :account_type, :comment)';
    $stmt = $pdo->prepare($addUser);
    $stmt->execute(["name" => "$user_name", "surname" => "$user_surname", "email" => "$email", "password" => "$password", "account_type" => "$account_type", "comment" => "$comment"]);
    $getSession = 'SELECT user_id, email, account_type FROM user WHERE email = ?';
    $stmt = $pdo->prepare($getSession);
    $stmt->execute(["$email"]);

    $newUserDir = $stmt->fetchAll();

    foreach ($newUserDir as $id) {
        $dirId = $id['user_id'];
        mkdir('./'  . "users" . DIRECTORY_SEPARATOR . $dirId);
        mkdir('./'  . "users" . DIRECTORY_SEPARATOR . $dirId . DIRECTORY_SEPARATOR . "files");
        mkdir('./'  . "users" . DIRECTORY_SEPARATOR . $dirId . DIRECTORY_SEPARATOR . "live");
    }

    $_SESSION['user_id'] = $dirId;
    $_SESSION['user_email'] = $_POST['new_email'];
    $_SESSION['user_account_type'] = $_POST['account_type'];

}

function isAuthorized()
{
    if (!empty($_SESSION['user_email'])) {
        return true;
    } else {
        return false;
    }
}

function newCampaign($priceCPM, $campaignName, $timeValue, $campaignRegion, $placementType)
{
    global $pdo;
    global $today;
    $userId = $_SESSION['user_id'];
    $campaignId = $_SESSION['user_id'] . $today;

        $timeList = implode(',', $timeValue);

            $regionList = implode(',', $campaignRegion);

                $typeList = implode(',', $placementType);


    $addCampaign = 'INSERT INTO campaigns(user_id, campaign_id, campaign_name, campaign_time, campaign_city, campaign_cpm, campaign_placement_type) VALUES ( :userId, :campaignId, :campaignName, :time, :region, :price, :type)';
    $stmt = $pdo->prepare($addCampaign);
    $stmt->execute(["userId" => "$userId", "campaignId" => "$campaignId", "campaignName" => "$campaignName", "time" => "$timeList", "region" => "$regionList", "price" => "$priceCPM", "type" => $typeList]);
}

function getCampaignIdNameCPM($userId)
{
    global $pdo;
    $getCampaignIdNameCPM = 'select user_id, campaign_id, campaign_name, group_concat(DISTINCT campaign_city), campaign_cpm, group_concat(DISTINCT campaign_placement_type) from (select distinct user_id, campaign_id, campaign_name, campaign_city, campaign_cpm, campaign_placement_type from campaigns) campaigns WHERE user_id = ? group by campaign_name';
    $stmt = $pdo->prepare($getCampaignIdNameCPM);
    $stmt->execute(["$userId"]);
    $campaignIds = $stmt->fetchAll();
    return $campaignIds;

}

function getCity()
{
    global $pdo;
    $getCity = 'select * from region';
    $stmt = $pdo->prepare($getCity);
    $stmt->execute();
    $cities = $stmt->fetchAll();
    return $cities;
}

function getPlaceCategory()
{
    global $pdo;
    $getPlaceCategory = 'select * from placecategories';
    $stmt = $pdo->prepare($getPlaceCategory);
    $stmt->execute();
    $category = $stmt->fetchAll();
    return $category;
}

function getCampaignId($userId)
{
    global $pdo;
    $getCampaignIdNameCPM = 'select user_id, campaign_id, campaign_name from campaigns WHERE user_id = ? group by campaign_name';
    $stmt = $pdo->prepare($getCampaignIdNameCPM);
    $stmt->execute(["$userId"]);
    $campaignIds = $stmt->fetchAll();
    return $campaignIds;

}

function logout()
{
    session_destroy();
}