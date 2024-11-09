<!-- app/View/Notes/create.ctp -->
<form action="<?php echo $this->Html->url('/Notes/create'); ?>" method="POST">
    <?php echo $this->Form->error('Notes.body'); ?>

    コメント<br />
    <textarea name="body" cols="40" rows="8"></textarea>

    <input type="submit" value="コメントを作成">
    <?php echo $this->Form->hidden('task_id', array('value' => $taskId)); ?>
</form>