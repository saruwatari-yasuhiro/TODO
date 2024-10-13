<?php
App::uses('PrgComponent', 'Search.Controller.Component');

class TasksController extends AppController
{
    public $helpers = array('Html', 'Form', 'Flash', 'Js');

    public function index()
    {

        // if (class_exists('Search.Controller.Component.PrgComponent')) {
        //     $this->set('message', 'PrgComponent クラスが存在します');
        // } else {
        //     $this->set('message', 'PrgComponent クラスが存在しません');
        // }


        // $options = array(
        //     'conditions' => array('Task.status' => 0)
        // );
        // $tasks_data = $this->Task->find('all', $options);
        // $this->set('tasks_data', $tasks_data);

        // $this->render('index');

        // ページングの設定
        $this->paginate = array(
            'conditions' => array('Task.status' => 0),  // 条件を指定
            'limit' => 5,  // 1ページあたりの件数
            'order' => array('Task.created' => 'desc')  // 必要に応じて並び順を指定
        );

        // ページングされたデータを取得
        $tasks_data = $this->paginate('Task');
        $this->set('tasks_data', $tasks_data);
        
        // ビューのレンダリング
        $this->render('index');
    }

    public function done()
    {
        //URLから更新対象IDを取得
        $id = $this->request->pass[0];
        $this->Task->id = $id;
        $this->Task->saveField('status', 1);
        $msg = sprintf('タスク %s を完了しました。', $id);

        $this->flash($msg, '/Tasks/index');
    }

    public function create()
    {
        if ($this->request->is('post')) {
            $this->Task->create();

            // フォームからファイルを取得
            $file = isset($this->request->data['file']) ? $this->request->data['file'] : null;

            if (!empty($file['name'])) {
                $uploadPath = WWW_ROOT . 'files' . DS . 'tasks' . DS;
                $filename = time() . '_' . basename($file['name']);
                $destination = $uploadPath . $filename;

                // ファイルをアップロード
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    $this->request->data['Task']['file_path'] = 'files/tasks/' . $filename;
                } else {
                    $this->Session->setFlash(__('File upload failed.'));
                    $this->render('create');
                    return;
                }
            } else {
                $this->request->data['Task']['file_path'] = null;
            }

            $data = array(
                'name' => $this->request->data['name'],
                'body' => $this->request->data['body'],
                'file_path' => $this->request->data['Task']['file_path'],
            );

            if ($this->Task->save($data)) {
                $msg = sprintf('タスク %s を登録しました。', $this->Task->id);
                $this->Session->setFlash($msg);
                $this->redirect('index');
                return;
            } else {
                $this->Session->setFlash(__('タスクの登録に失敗しました。'));
            }
        }
        $this->render('create');
    }

    public function edit()
    {
        // 指定されたタスクのデータを取得
        $id = $this->request->pass[0];
        $options = array(
            'conditions' => array(
                'Task.id' => $id,
                'Task.status' => 0
            )
        );
        $task = $this->Task->find('first', $options);

        // データが見つからない場合は一覧へ
        if ($task == false) {
            $this->Session->setFlash('タスクが見つかりません');
            $this->redirect('/Tasks/index');
        }

        // フォームが送信された場合は更新にトライ
        if ($this->request->is('post')) {
            $data = array(
                'id' => $id,
                'name' => $this->request->data['Task']['name'],
                'body' => $this->request->data['Task']['body']
            );
            if ($this->Task->save($data)) {
                $this->Session->setFlash('更新しました');
                $this->redirect('/Tasks/index');
            }
        } else {
            // POSTされていない場合は初期データをフォームにセット
            $this->request->data = $task;
        }
    }
}
