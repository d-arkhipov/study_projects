<?php

//Регистрируем класс в пространстве имён.
namespace app\models\tables;


/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property int $owner_id
 * @property int $responsible_id
 * @property string $status
 * @property string $date
 * @property string $date_start
 * @property string $date_end
 * @property string $description
 *
 * @property Users $responsible
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'owner_id', 'status', 'date'], 'required'],
            [['owner_id', 'responsible_id'], 'integer'],
            [['date', 'date_start', 'date_end'], 'safe'],
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
            'date' => 'Date',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'description' => 'Description',
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
}
