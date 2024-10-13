<!-- app/View/Tasks/index.ctp -->
<?php echo $this->Html->link('新規タスク', '/Tasks/create'); ?>
<h3><?php echo $total_count; ?>件のタスクが未完了です</h3>

<?php foreach ($tasks_data as $row) : ?>
    <?php echo $this->element('task', array('task' => $row)) ?>
<?php endforeach; ?>


<!-- ページネーションリンクの追加 -->

<div class="pagination">
    <?php
    echo $this->Paginator->prev('« 前へ', array(), null, array('class' => 'disabled'));
    echo $this->Paginator->numbers(array('separator' => ' | '));
    echo $this->Paginator->next('次へ »', array(), null, array('class' => 'disabled'));
    ?>
</div>