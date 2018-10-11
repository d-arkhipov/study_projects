<?php
header("Content-type:text/html; charset:utf-8");

//5. Дан код. Что он выведет на каждом шаге? Почему?
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();//Ничего. Т.к. мы не вызывем никакой метод.
$a2 = new A();//Тоже самое.
$a1->foo();//1. Увеличит на 1(преинкремент) и выведет значение на экран.
$a2->foo();//2. Метод статический, поэтому для всех экземпляров класса один.
$a1->foo();//3, по той же причине.
$a2->foo();//4.

//6. Немного изменим п.5. Объясните результаты в этом случае.
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();//Ничего, т.к. просто создаем экземпляр без вызова метода.
$b1 = new B();//Тоже самое.
$a1->foo();//1. Увеличит на 1(преинкремент) и выведет значение на экран.
$b1->foo();//1. Мы унаследовали класс B от класса A. Соответственно при создании экземпляра будет
           //использоваться метод и статическая переменная класса B.
$a1->foo();//2. Метод статический, поэтому для всех экземпляров класса А он один.
$b1->foo();//2. Такой же метод, для объектов класса B.


//7. *Дан код. Что он выведет на каждом шаге? Почему?
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A;//Ничего. Результат аналогичен предыдущему примеру. Т.к. у нас нет конструктора и не нужно передавать
            //параметры, допускается создание нового экземпляра без "()".
$b1 = new B;//Ничего.
$a1->foo();//1 -=-.
$b1->foo();//1 -=-.
$a1->foo();//2 -=-.
$b1->foo();//2 -=-.