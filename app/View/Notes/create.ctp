<!-- app/View/Notes/create.ctp -->
<?php echo $this->Form->create('Note', array('url' => array('action' => 'create'))); ?>

<?php echo $this->Form->input('body', array('type' => 'textarea', 'label' => 'コメント', 'cols' => 40, 'rows' => 8)); ?>
<!-- エラー表示を個別に処理
<?php
$errors = $this->Form->error('body');
if (!empty($errors)) {
    echo $errors;
}
?> -->

<?php echo $this->Form->hidden('task_id', array('value' => $taskId)); ?>
<?php echo $this->Form->end('コメントを作成'); ?>