<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use dastanaron\translit\Translit;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $title
 * @property string $date
 */
class Image extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date','image'], 'required'],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 5],
            [['date'], 'safe'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'date' => 'Дата и время загрузки',
            'image' => 'Картинка',
        ];
    }
    public function add(){
        $translit = new Translit();
        $this->image = UploadedFile::getInstances($this, 'image');
        foreach($this->image as $img){
            $this->title = '';
            $this->date = '';
            $temp_name =  mb_strtolower($translit->translit($img->baseName, true, 'ru-en'));

            if(file_exists('files/'.$temp_name.'.'.$img->extension)){
                $temp_name.="_".time();
            }
            $temp_name.='.'.$img->extension;
            
            if($img->saveAs('files/'.$temp_name)){
                $model = new Image();
                $model->title = $temp_name;
                $model->date = date('Y-m-d H:i:s');
                $model->save(false);
            }
        }
        Yii::$app->session->setFlash('success', 'Вы успешно добавили '.count($this->image).' изоб.');
        return true;
    }
    
}
