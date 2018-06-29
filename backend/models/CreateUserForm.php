<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class CreateUserForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $admin;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['admin', 'boolean']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function addNew()
    {
        
        if (!$this->validate()) {
            return null;
        }
        //die("oi kui halb");
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($user->save()){
            if($this->admin){
                $auth = \Yii::$app->authManager;
                $authorRole = $auth->getRole('author');
                $auth->assign($authorRole, $user->getId());
            } 
            else{
                $auth = \Yii::$app->authManager;
                $authorRole = $auth->getRole('author');
                $auth->assign($authorRole, $user->getId());
            }

            return $user;
        }
        else return null;
    }
}
