<?php
//Регистрируем класс в пространстве имён.
namespace app\validators;

//Импортируем класс.
use yii\validators\Validator;


//Класс для валидации статуса задания.
class StatusValidator extends Validator
{
    /**
     * Метод описывает собственное правило валидации статуса.
     * @param $model - Класс модели, в которой будет происходить проверка.
     * @param $attribute - Имя валидируемого аттрибута.
     */
    public function validateAttribute($model, $attribute) {
        //Сохраняем в переменную массив с доступными статусами.
        $statusArr = ['Новая', 'Аналитика', 'В работе', 'Готова к тестированию', 'Закрыта'];
        //Если указанного статуса нет в массиве,
        if (!in_array($model->$attribute, $statusArr)) {
            //записываем ошибку.
            $model->addError($attribute, 'Указан неверный статус.');
        }
    }
}