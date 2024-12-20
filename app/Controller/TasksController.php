<?php

class TasksController extends AppController
{
    public $helpers = array('Html', 'Form', 'Flash', 'Js');

    public function index()
    {

        // ページングの設定
        $this->paginate = array(
            'conditions' => array('Task.status' => 0),  // 条件を指定
            'limit' => 5,  // 1ページあたりの件数
            'order' => array('Task.created' => 'desc')  // 必要に応じて並び順を指定
        );

        // ページングされたデータを取得
        $tasks_data = $this->paginate('Task');
        $this->set('tasks_data', $tasks_data);
        // 全体件数の取得
        $total_count = $this->params['paging']['Task']['count'];
        $this->set('total_count', $total_count);

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
            $file = isset($this->request->data['Task']['file']) ? $this->request->data['Task']['file'] : null;

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
            if ($this->request->data['Task']['action'] === 'delete') {
                // 削除処理
                return $this->delete($id);
            } else {
                // 更新処理
                $data = array(
                    'id' => $id,
                    'name' => $this->request->data['Task']['name'],
                    'body' => $this->request->data['Task']['body']
                );
                if ($this->Task->save($data)) {
                    $this->Session->setFlash('更新しました');
                    $this->redirect('/Tasks/index');
                }
            }
        } else {
            // POSTされていない場合は初期データをフォームにセット
            $this->request->data = $task;
        }

        // タスクデータをビューに渡す
        $this->set(compact('task'));
    }

    /**
     * 削除機能
     * @return void
     */
    public function delete($id = null)
    {
        $this->Task->id = $id;
        if (!$this->Task->exists()) {
            throw new NotFoundException(__('無効なタスクです。'));
        }

        if ($this->Task->delete()) {
            $this->Session->setFlash(__('タスクが削除されました。'));
        } else {
            $this->Session->setFlash(__('タスクの削除に失敗しました。'));
        }

        return $this->redirect(array('action' => 'index')); // 削除後はインデックスにリダイレクト
    }
}
