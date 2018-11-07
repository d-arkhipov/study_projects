<?php

//Регистрируем класс в пространстве имен.
namespace app\traits;


//Реализуем трейт для повторного использования кода(паттерн "Одиночка").
trait TSingleton
{
    //Создаем защищенное статическое свойство для хранения единственного экземпляра класса.
    protected static $instance;

    //Запрещаем создание объекта.
    private function __construct()
    {
    }

    //Запрещаем клонирование объекта.
    private function __clone()
    {
    }

    //Запрещаем восстановление объекта из серриализованных данных.
    private function __wakeup()
    {
    }


    /**
     * Метод проверяет наличие экземпляра класса и в случае отсутствия такогово - создаёт.
     * @return object - Возвращает текущий объект.
     */
    public static function getInstance()
    {
        //Проверяем пустое ли статическое свойство $instance.
        if (is_null(static::$instance)) {
            //Создаём новый экземпляр текущего класса.
            //static использует позднее статическое связывание.
            static::$instance = new static();
        }
        //Если такой объект уже создан, то возвращаем его.
        return static::$instance;
    }
}