<?php

//КЛАСС НЕ АКТИВЕН. ИСПОЛЬЗУЕМ АВТОЛОАДЕР КОМПОЗЕРА.

//Регистрируем класс в пространстве имен "app\services".
namespace app\services;

//Класс реализует автоматическое подключение скриптов.
class Autoloader
{
    /**
     * Функция формирует полный путь к файлу и подключает его.
     * @param string $className - Имя класса, который необходимо подключить.
     */
    public function loadClass($className) {
        //Формируем строку с именем, включающую в себя пространство имен,
        //без абстрактного корневого каталога "\app".
        $className = str_replace(["app\\", "\\"], [ROOT_DIR, "/"], $className) . '.php';
        //Если файл существует.
        if (file_exists($className)) {
            //Подключаем его.
            include $className;
        }
    }
}