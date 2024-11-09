<?php

class NotesController extends AppController
{

    public $helpers = array('Html', 'Form', 'Flash', 'Js');

    public function create($taskId = null)
    {
        if ($this->request->is('post')) {

            // $taskId が null の場合にエラーを表示してリダイレクト
            $taskId = $this->request->data['task_id'];
            if (empty($taskId)) {
                $this->Session->setFlash(__('タスクIDが指定されていません。'));
                return $this->redirect('/Notes/index'); // リダイレクト先を指定
            }

            $this->Note->create();
            $data = array(
                'body' => $this->request->data['body'],
                'task_id' => $taskId // task_id をデータに含める
            );

            if ($this->Note->save($data)) {
                $msg = sprintf('コメント %s を登録しました。', $this->Note->id);
                $this->Session->setFlash($msg);
                // $this->redirect('index');
                $this->redirect('/Tasks/index');
            } else {
                $this->Session->setFlash(__('コメントの登録に失敗しました。'));
            }
        }
        $this->set(compact('taskId'));
        $this->render('create');
    }
}
