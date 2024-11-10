<?php
App::uses('AppModel', 'Model');

class Task extends AppModel
{
    public $hasMany = array('Note');

    public $name = 'Task';

    public $validate = array(
        'name' => array(
            'rule' => array('maxLength', 60),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'タスク名を入力して下さい'
        ),
        'body' => array(
            'rule' => array('maxLength', 255),
            'required' => true,
            'allowEmpty' => false,
            'message' => '詳細を入力して下さい'
        ),
        'file' => array(
            'rule' => array('extension', array('jpg', 'jpeg', 'png', 'pdf')),
            'message' => '有効なファイルを指定してください(jpg, jpeg, png, pdf).',
            'allowEmpty' => true
        )
    );

}
