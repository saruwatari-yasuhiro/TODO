<!-- File: /app/View/Posts/view.ctp -->

<h1><?php echo h($post['Post']['title']); ?></h1>

<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>

<p><?php echo h($post['Post']['body']); ?></p>

<?php
if (!empty($task['Task']['file_path'])) {
    echo $this->Html->link('Download file', '/' . $task['Task']['file_path']);
}
?>