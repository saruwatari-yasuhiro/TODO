<?php
class TaskFixture extends CakeTestFixture {
    public $import = array('model' => 'Task', 'records' => true);

    public $records = array(
        array(
            'id' => 1,
            'name' => 'Test Task 1',
            'body' => 'This is a test task.',
            'status' => 1
        ),
        array(
            'id' => 2,
            'name' => 'Test Task 2',
            'body' => 'This is another test task.',
            'status' => 0
        ),
    );
}
