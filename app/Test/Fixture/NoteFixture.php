<?php
class NoteFixture extends CakeTestFixture {
    public $import = array('model' => 'Note', 'records' => true);

    public $records = array(
        array('id' => 1, 'task_id' => 1, 'body' => 'Note 1', 'created' => '2024-10-01 12:00:00'),
        array('id' => 2, 'task_id' => 1, 'body' => 'Note 2', 'created' => '2024-10-01 13:00:00'),
    );
}