<?php
// app/Model/User.php
class User extends AppModel
{
    public $validate = array(
        'email' => array(
            'rule' => 'email',
            'message' => 'Valid email address required',
            'required' => true
        ),
        'password' => array(
            'rule' => 'notBlank',
            'message' => 'Password required',
            'required' => true
        )
    );

    public function beforeSave($options = array())
    {
        if (isset($this->data['User']['password']) && !empty($this->data['User']['password'])) {
            // パスワードをハッシュ化
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }
}
