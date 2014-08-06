<?php
/**
 * Created by SonHA
 * User: Son Ha Anh (sonhaanh@vccorp.vn)
 * Date: 7/16/14
 * Time: 1:43 PM
 * To change this template use File | Settings | File Templates.
 */
class UserController extends Controller{

//    public $layout='//layouts/new_layout';
    /*
     * $defaultAction
     * Set default action in controller
     * Neu khong co $defaultAction nay thi se lay actionIndex lam action mac dinh.
     */
    public $defaultAction = 'listUser';

    public function actionIndex() {
        /**
         * Khai bao trong config/main.php nhu sau
         * 'defaultController' => 'user',
         */
        echo 'Day la default Controller';
        die();
    }
    /**
     * Todo: Ham list toan bo User
     * Author: Son Ha Anh (sonhaanh@vccorp.vn)
     * Create:
     * Update:
     * Output: None
     * Link : http://localhost/xpro/www/index.php?r=user/listUser
     */
    public function actionListUser() {
//        $this->layout = '//layouts/new_layout';
        $model = new User1();
//        $listUser = $model->findAll();
//        $listUser = $model->findAll(array('order'=>'id asc'));
        //B2: lay tat ca du lieu trong bang User
        $listUser = $model->findAll(array('order'=>'id desc'));
        //B3: dua du lieu ra view
        $this->render('list',array('listUser' => $listUser));
    }

    /**
     * Todo: Ham tao user moi
     * Author: Son Ha Anh (sonhaanh@vccorp.vn)
     * Create:
     * Update:
     * Output: None
     */
    public function actionCreateUser(){
        $model = new User1();
        if (isset($_POST)) {
            $model->username = $_POST['username'];
            $model->email = $_POST['email'];
            $model->facebook = $_POST['facebook'];
            $model->mobile = $_POST['mobile'];
            $model->address = $_POST['address'];
            $model->role = $_POST['role'];
            if ($model->save()) {
                Yii::app()->user->setFlash('createUser', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
                //redirect den trang list User sau khi insert
                //http://localhost/xpro/www/index.php?r=user/listUser
//                $this->redirect(array('listUser'));
            }
        }

        $this->render('create');
    }

    /**
     * Todo: Ham tao user moi
     * Author: Son Ha Anh (sonhaanh@vccorp.vn)
     * Create:
     * Update:
     * Output: None
     */
    public function actionUpdateUser($id){
        //lay thong tin user
        $model = $this->loadModel($id);

        if (isset($_POST['submit'])) {
            $model->username = $_POST['username'];
            $model->email = $_POST['email'];
            $model->facebook = $_POST['facebook'];
            $model->mobile = $_POST['mobile'];
            $model->address = $_POST['address'];
            $model->role = $_POST['role'];
            if ($model->save()) {
//                Yii::app()->user->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                //redirect den trang list User sau khi insert
                //http://localhost/xpro/www/index.php?r=user/listUser
                $this->redirect(array('listUser'));
            }
        }
        $this->render('update',array('model' => $model));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Product the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=User::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    ///////////////////////////////////////////////////////
    /**
     *
     */
    public function actionPreRegister(){
      //tạo layout rieng cho chức năng Register
        // Gọi layout
        $this->layout="//layout/empty";
        $this->render("preRegister");
    }
    public function actionRegister(){
        // NHận dữ liệu đăng ký
        $username= isset($_POST['username'])?$_POST['username']:"";
        $email= isset($_POST['email'])?$_POST['email']:"";
        $pass= isset($_POST['pass'])?$_POST['pass']:"";
        $register= isset($_POST['register'])?$_POST['register']:"";

        // Xử lý dữ liệu đăng ký
        // Kiểm tra user đã tồn tại chưa ?
            // Tạo model liên kết với bảng user trong database
        //Check đã tồn tại user chưa?
        //keyword  find object with condition Yii CactiveRecord
        // cách 1 dùng funciton sẵn có của CactiveRecord
        // cách 2 dùng lệnh Sql ;
         $user_model= new User();
        if($user_model->checkUserExist($username)){
            echo "user da ton tai";exit;
        }else{
            // validate email  co 2 cach
            // cach1 tim ham php co san check mail validate PHP
            // cach 2 dung chuc nang validate co san cua yii
            $user_model->username=$username;
            $user_model->email=$email;
            $user_model->pass=md5($pass);
            if($user_model->save()){
              // Gui mail kich hoat
//                mail(); xampp khong gui duoc
                // PHP mailer ; config nguoi gui la tai khoan mail bat ki ; ket noi voi tai khoan qua SMTP
                // Thoong bao loi bang flash mfessage FlashMessage Yii
                echo "luu thanh cong";exit;
            }else{
                // thong bao co loi xay ra
                echo "co loi xay ra";exit;
            }
        }


    }

    public function actionPreSendMail() {
        $this->render('send_mail');
    }

    public function actionSendEmailUser() {
        Util::sendEmail('hason61vn@gmail.com', 'Test email', 'ay la contentD');
    }

    public function actionSendGmailUser() {
        Util::sendEmailGmail('hason61vn@gmail.com', 'Test email', 'ay la contentD');
    }

    /**
     * Function ActiveUser
     * @author : SonHA
     * @date :
     */
    public function actionActiveUser(){
        $userId = $_GET['userId'];
        $verifyCode = $_GET['activationKey'];
        $model = new User1();
        $user = $model->findByPk($userId);
        if($user->activationKey == $verifyCode) {
            $user->status = 1;
            if($user->save()) {
            echo 'Kich hoat thanh cong';
            } else {
//                var_dump($user->getErrors());die;
            }
        } else {
            echo 'Kich hoat khong thanh cong';
        }
    }
}