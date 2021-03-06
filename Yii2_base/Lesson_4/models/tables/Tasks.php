<?php

//Регистрируем класс в пространстве имён.
namespace app\models\tables;


//Используем классы.
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property int $owner_id
 * @property int $responsible_id
 * @property string $status
 * @property string $created_at
 * @property string $date_start
 * @property string $date_end
 * @property string $description
 * @property string $updated_at
 *
 * @property Users $responsible
 * @property Users $owner
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * Метод-поведение, который добавляет временную метку к полям "created_at" и "updated_at".
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'owner_id', 'status'], 'required'],
            [['owner_id', 'responsible_id'], 'integer'],
            [['created_at', 'updated_at', 'date_start', 'date_end'], 'safe'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 64],
            [['status'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'owner_id' => 'Owner',
            'responsible_id' => 'Responsible',
            'status' => 'Status',
            'created_at' => 'Date create',
            'date_start' => 'Date start',
            'date_end' => 'Date end',
            'description' => 'Description',
            'updated_at' => 'Date update'
        ];
    }

    /**
     * Метод устанавливает связь между двумя таблицами по определённым полям.
     * @return \yii\db\ActiveQuery
     */
    public function getResponsible()
    {
        return $this->hasOne(Users::class, ['id' => 'responsible_id']);
    }

    /**
     * Метод устанавливает связь между двумя таблицами по определённым полям.
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Users::class, ['id' => 'owner_id']);
    }
}