<?php


namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public function rules()
    {
        return [
            [['imageFile'],'file','skipOnEmpty' => false,'extensions' => 'png,jpg','maxFiles' => 4],
        ];
    }

    public function upload()
    {
        if ($this->validate()){
            foreach ($this->imageFile as $file) {
//                $this->imageFile->saveAs('../uploads/' .$this->imageFile->baseName. '.' .$this->imageFile->extension);
//                $file->saveAs('../uploads'. $file->baseName. '.' .$file->extension);
                $file->saveAs('../uploads/' .$file->baseName. '.' .$file->extension);
            }
            return true;
        }else{
            return false;
        }
    }

}
