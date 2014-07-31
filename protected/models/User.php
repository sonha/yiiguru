<?php

/**
 * This is the model class for table "type".
 *
 * The followings are the available columns in table 'type':
 * @property integer $id
 * @property string $type_name
 */
class User extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'user';
	}


    public function checkUserExist($userName){
        $sql ="select * from user where username='".$userName."'";
        $query= Yii::app()->db->createCommand($sql);
//            $query->bindValue(':username',isset($model->username)?$model->username:null);
        if(count($query->queryAll())>0){
            return true;
        }else{
            return false;
        }
    }

}