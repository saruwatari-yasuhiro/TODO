<!-- app/View/Tasks/create.ctp -->
<form action="<?php echo $this->Html->url('/Tasks/create'); ?>" method="POST" enctype="multipart/form-data">
    <?php echo $this->Form->error('Task.name'); ?>
    <?php echo $this->Form->error('Task.body'); ?>
    <?php echo $this->Form->error('Task.file'); ?>

    タスク名<input type="text" name="name" size="40">
    詳細<br />
    <textarea name="body" cols="40" rows="8"></textarea>

    <!-- ファイルアップロード用フィールド -->
    ファイルアップロード: <?php echo $this->Form->input('Task.file', array('type' => 'file')); ?>
    <!-- ファイルアップロード: <input type="file" name="data[file]" id="file"><br> -->

    <input type="submit" value="タスクを作成">
</form>