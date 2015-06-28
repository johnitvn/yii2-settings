<?php
namespace johnitvn\settings\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use Yii;
use johnitvn\ajaxcrud\TouchableInterface;

class Setting extends ActiveRecord 
implements TouchableInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['section', 'key'], 'string', 'max' => 255],
            [['type', 'created', 'modified'], 'safe'],
            ['type','in','range'=>['boolean','integer','string'],'strict'=>true],
            [['active'], 'boolean'],
        ];
    }
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        Yii::$app->settings->clearCache();
    }
    public function afterDelete()
    {
        parent::afterDelete();
        Yii::$app->settings->clearCache();
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' =>'Type',
            'section' => 'Section',
            'key' =>'Key',
            'value' => 'Value',
            'active' => 'Active',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'modified',
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function getSettings()
    {
        $settings = static::find()->where(['active' => 1])->asArray()->all();
        return array_merge_recursive(
            ArrayHelper::map($settings, 'key', 'value', 'section'),
            ArrayHelper::map($settings, 'key', 'type', 'section')
        );
    }
    /**
     * @inheritdoc
     */
    public function setSetting($section, $key, $value, $type = null)
    {
        $model = static::findOne(['section' => $section, 'key' => $key]);
        if ($model === null) {
            $model = new static();
            $model->active = 1;
        }
        $model->section = $section;
        $model->key = $key;
        $model->value = strval($value);
        if ($type !== null) {
            $model->type = $type;
        } else {
            $model->type = gettype($value);
        }
        return $model->save();
    }
    /**
     * @inheritdoc
     */
    public function activateSetting($section, $key)
    {
        $model = static::findOne(['section' => $section, 'key' => $key]);
        if ($model && $model->active == 0) {
            $model->active = 1;
            return $model->save();
        }
        return false;
    }
    /**
     * @inheritdoc
     */
    public function deactivateSetting($section, $key)
    {
        $model = static::findOne(['section' => $section, 'key' => $key]);
        if ($model && $model->active == 1) {
            $model->active = 0;
            return $model->save();
        }
        return false;
    }
    /**
     * @inheritdoc
     */
    public function deleteSetting($section, $key)
    {
        $model = static::findOne(['section' => $section, 'key' => $key]);
        if ($model) {
            return $model->delete();
        }
        return true;
    }
    /**
     * @inheritdoc
     */
    public function deleteAllSettings()
    {
        return static::deleteAll();
    }

    
    /**
    * 
    * @return array the list of fields can touch
    * example:
    *   return ['block',active']
    */
    public function getTouchableFields(){

    }   


    /**
    * @return array the list of touchable button 's label 
    * 
    * example:
    *   return [
    *       'block'=>[
    *           'true'=>'Block',
    *           'false'=>'UnB\block',
    *       ]
    *   ];
    */
    public function getTouchableButtonLabels(){

    }

    /**
    * @param string $fieldName The name of field want to touch
    * @return boolean the value after touch
    */
    public function touchField($fieldName){

    }
}