<?php echo $this->Form->create('Task', array('type' => 'post', 'id' => 'TaskEditForm')); ?>
<!-- まとめて表示を行う例 -->
<div class="input text required">
    <label for="TaskName">タイトル</label>
    <?php echo $this->Form->input('Task.name', array('type' => 'text', 'value' => $task['Task']['name'], 'required' => true)); ?>
</div>
<div class="input textarea required">
    <label for="TaskBody">詳細</label>
    <?php echo $this->Form->input('Task.body', array('type' => 'textarea', 'value' => $task['Task']['body'], 'required' => true)); ?>
</div>

<!-- 隠しフィールドを使ってactionを指定 -->
<?php echo $this->Form->input('action', array('type' => 'hidden', 'value' => 'update', 'id' => 'actionField')); ?>
<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $task['Task']['id'])); ?>

<!-- 保存ボタン -->
<div class="submit">
    <?php echo $this->Form->button('保存', array(
        'type' => 'submit',
        'onclick' => "document.getElementById('actionField').value = 'update';"
    )); ?>
</div>

<!-- 削除ボタン -->
<div class="submit">
    <?php echo $this->Form->button('削除', array(
        'type' => 'submit',
        'onclick' => "document.getElementById('actionField').value = 'delete'; return confirm('本当に削除しますか？');",
        'class' => 'btn btn-danger'
    )); ?>
</div>

<?php echo $this->Form->end(); ?>
