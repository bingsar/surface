<?php

session_start();

function login($login, $password)
{
    $user = getUser($login);
    if (($user && $user['password'] == $password)) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}

function guest()
{
    $guest = $_GET['name'];
    $_SESSION['user'] = $guest;
    return $guest;
}

function getUsers()
{
   $usersData = file_get_contents(__DIR__ . '/users.json');
   $users = json_decode($usersData,true);
   if (empty($users)) {
       return [];
   }
   return $users;
}

function getUser($login)
{
    $users = getUsers();

   foreach ($users as $user) {
       if ($login === $user['login']) {
           return $user;
       }
   }
  return null;
}

function isAuthorized()
{
   return !empty($_SESSION['user']);
}

function getAuthorizedUser()
{
   return $_SESSION['user']['username'];
}

function logout()
{
    session_destroy();
}

function jsonAddName()
{
    echo '<pre>';
    $filename = 'users.json';
    $get = file_get_contents($filename);
    $json = json_decode($get, true) or exit('Can\'t decode');
    $addName = array_merge($json, $_GET);
    $json = json_encode($addName);
    $file = fopen('users.json', 'w');
    fwrite($file,$json);
    fclose($file);

}

function jsonDeleteName()
{
    $filename = 'users.json';
    $get = file_get_contents($filename);
    $json = json_decode($get, true) or exit('Can\'t decode');
    unset($json['name']);
    $json = json_encode($json);
    $file = fopen('users.json', 'w');
    fwrite($file,$json);
    fclose($file);
}

function truePath()
{

}