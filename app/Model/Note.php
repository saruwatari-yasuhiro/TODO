<?php
App::uses('AppModel', 'Model');

class Note extends AppModel
{

    public $belongsTo = array('Task');

    public $validate = array(
        'body' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'コメントを入力して下さい',
                'allowEmpty' => false,
                'required' => true,
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => 'コメントは255文字以内で入力してください'
            ),
        ),
    );
}
