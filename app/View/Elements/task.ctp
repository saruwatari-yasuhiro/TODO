<!-- app/View/Elements/task.ctp -->
<?php echo $this->Html->css('task'); // CSSを読み込み 
?>
<div class="roundBox">
    <h3><?php echo h($task['Task']['id']); ?>
        :
        <?php echo h($task['Task']['name']); ?></h3>
    作成日 <?php echo h($task['Task']['created']); ?>
    <p class="comment">
    <ul>
        <?php foreach ($task['Note'] as $note) : ?>
            <li><?php echo h($note['body']); ?></li>
        <?php endforeach; ?>
    </ul>
    <?php echo $this->Html->link(
            'コメントを追加',
            array('controller' => 'Notes', 'action' => 'create', $task['Task']['id']) // task_id をURLに渡す
        ); ?>
    </p>
    <!-- アップロードされたファイルが存在するか確認 -->
    <?php if (!empty($task['Task']['file_path'])) : ?>
        <!-- ファイルのパスを生成 -->
        <?php $fileUrl = $this->Html->url('/' . $task['Task']['file_path']); ?>

        <!-- 画像を表示 -->
        <div class="task-image">
            <img src="<?php echo $fileUrl; ?>" alt="アップロードされた画像" style="max-width: 200px; max-height: 200px;">
        </div>
    <?php endif; ?>

    <?php echo $this->Html->link(
        '編集',
        '/Tasks/edit/' . $task['Task']['id'],
        array('class' => 'button left')
    ); ?>
    <?php echo $this->Html->link(
        '削除',
        '/Tasks/delete/' . $task['Task']['id'],
        array('class' => 'button center',
        'onclick' => 'return confirm("本当に削除しますか？");'
        )
    ); ?>
    <?php echo $this->Html->link(
        'このタスクを完了する',
        '/Tasks/done/' . $task['Task']['id'],
        array('class' => 'button right')
    ); ?>

</div>