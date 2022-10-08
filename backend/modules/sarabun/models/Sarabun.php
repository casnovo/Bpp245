<?php

namespace backend\modules\sarabun\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\helpers\Html;


/**
 * This is the model class for table "sarabun".
 *
 * @property int $id เลขทะเบียน
 * @property string $years ปี
 * @property string $books เลขที่หนังสือ
 * @property string $detills เรื่อง
 * @property string $bookdate วันที่เอกสาร
 * @property string|null $docurl เอกสาร
 * @property string $kinds ชนิดหนังสือ
 * @property string $kinds2 ประเภทหนังสือ
 * @property string $created_at สร้างเมื่อ
 * @property string|null $updated_at แก้ใขเมื่อ
 * @property string $created_by ผู้บันทึก
 * @property string|null $updated_by ผู้แก้ใข
 * @property int $unit_id หน่วยงาน
 * @property int $collection_id แฟ้ม
 * @property Collection $collection
 * @property Unit $unit
 * @property string $ref
 */
class Sarabun extends ActiveRecord
{
    const UPLOAD_FOLDER = 'sarabun';
    public $docs;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sarabun';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['books', 'detills', 'bookdate', 'kinds', 'kinds2', 'unit_id', 'collection_id'], 'required'],
            [['bookdate', 'ref'], 'safe'],
            [['unit_id', 'collection_id'], 'integer'],
            [['years'], 'string', 'max' => 4],
            [['books'], 'string', 'max' => 45],
            [['detills', 'docurl', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'string', 'max' => 100],
            [['kinds'], 'string', 'max' => 20],
            [['kinds2'], 'string', 'max' => 20],
            [['docs'], 'file', 'maxFiles' => 1],
            [['collection_id'], 'exist', 'skipOnError' => true, 'targetClass' => Collection::class, 'targetAttribute' => ['collection_id' => 'id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::class, 'targetAttribute' => ['unit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'เลขทะเบียน',
            'years' => 'ปี',
            'books' => 'เลขที่หนังสือ',
            'detills' => 'เรื่อง',
            'bookdate' => 'ลงวันที่',
            'docurl' => 'เอกสาร',
            'kinds' => 'ชนิดหนังสือ',
            'kinds2' => 'ประเภทหนังสือ',
            'created_at' => 'สร้างเมื่อ',
            'updated_at' => 'แก้ใขเมื่อ',
            'created_by' => 'ผู้บันทึก',
            'updated_by' => 'ผู้แก้ใข',
            'unit_id' => 'หน่วยงาน',
            'collection_id' => 'แฟ้ม',
            'ref' => 'คียอ้างอิงสำหรับเจสัน',
            'bookname' => 'ทะเบียนรับ/ส่ง',
            'Idyear'=>'เลขทะเบียน',
            'bookkindname'=>'ประเภทเอกสาร',
            'Fullbooks'=>'ที่หนังสือ',
            'unit'=>'หน่วย รับ/ส่ง',
        ];
    }

    /**
     * Gets query for [[Collection]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCollection()
    {
        return $this->hasOne(Collection::class, ['id' => 'collection_id']);
    }

    /**
     * Gets query for [[Unit]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::class, ['id' => 'unit_id']);
    }
    public function getUser()
    {
        return $this->hasOne(Unit::class, ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return SarabunQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SarabunQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'value' => Yii::$app->user->identity->Name,

            ],
         //   BlameableBehavior::className(),
            TimestampBehavior::className(),
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'years',
                ],
                'value' => function ($event) {
                    return $this->getThaiyear();
                },
            ],
        ];
    }


    public function getThaiyear()
    {
        return substr((string)((int)date("Y") + 543), 2);
    }

    public static function itemsAlias($key)
    {

        $items = [

            'book' => [
                'หนังสือรับ' => 'หนังสือรับ',
                'หนังสือส่ง' => 'หนังสือส่ง',
            ],
            'bookkind' => [
                'วิทยุ' => 'วิทยุ',
                'หนังสือ' => 'หนังสือ',
                'หนังสือภายนอก' => 'หนังสือภายนอก',
            ],
        ];
        return ArrayHelper::getValue($items, $key, []);
        //return array_key_exists($key, $items) ? $items[$key] : [];
    }

    public function getItemBook()
    {
        return self::itemsAlias('book');
    }

    public function getItemBookkind()
    {
        return self::itemsAlias('bookkind');
    }

    public function getBookName()
    {
        return ArrayHelper::getValue($this->getItemBook(), $this->kinds);
    }

    public function getBookkindName()
    {
        return ArrayHelper::getValue($this->getItemBookkind(), $this->kinds2);
    }
    public function getIdyear()
    {
        return $this->id.'/'.$this->years;;
    }
    public function getFullbooks()
    {
        return $this->unit->codename.'/'.$this->books;
    }

    public static function getUploadPath()
    {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER . '/';
    }

    public static function getUploadUrl()
    {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER . '/';
    }

    public function initialPreview($data,$field,$type='file'){
        $initial = [];
        $files = Json::decode($data);
        if(is_array($files)){
            foreach ($files as $key => $value) {
                if($type=='file'){
                    $initial[] = "<div class='file-preview-other'></div>";
                }elseif($type=='config'){
                    $initial[] = [
                        'caption'=> $value,
                        'width'  => '120px',
                        'url'    => Url::to(['sarabun/Deletefile','id'=>$this->id,'fileName'=>$key,'field'=>$field]),
                        'key'    => $key
                    ];
                }
                else{
                    $initial[] = Html::img(self::getUploadUrl().$this->ref.'/'.$value,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
                }
            }
        }
        return $initial;
    }
    public function listDownloadFiles(){
        $docs_file = '';
            $data = $this->docurl;
            $files = Json::decode($data);
            if(is_array($files)){

                foreach ($files as $key => $value) {
                    $docs_file = Html::a($value,['sarabun/download','id'=>$this->id,'file'=>$key]);
                }

            }


        return $docs_file;
    }


}
