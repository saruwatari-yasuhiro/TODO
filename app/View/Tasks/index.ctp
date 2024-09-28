<!-- app/View/Tasks/index.ctp -->
<!-- <?php
        Cache::write('test_key', 'This is a test value.');
        echo Cache::read('test_key');
        ?> -->
<?php echo $this->Html->link('新規タスク', '/Tasks/create'); ?>
<h3><?php echo count($tasks_data); ?>件のタスクが未完了です</h3>

<?php
echo $this->Form->create('Task', array('type' => 'get'));
echo $this->Form->input('name', array('label' => 'タスク名'));
echo $this->Form->input('body', array('label' => '詳細'));
echo $this->Form->input('status', array('label' => 'ステータス', 'type' => 'select', 'options' => array('open' => 'Open', 'completed' => 'Completed')));
echo $this->Form->button('検索');
echo $this->Form->end();
?>


<?php foreach ($tasks_data as $row) : ?>
    <?php echo $this->element('task', array('task' => $row)) ?>
<?php endforeach; ?>