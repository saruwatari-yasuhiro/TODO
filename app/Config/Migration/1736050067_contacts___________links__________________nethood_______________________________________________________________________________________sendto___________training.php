<?php
class ContactsLinksNetHoodSendToTraining extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'Contacts___________Links__________________NetHood_______________________________________________________________________________________SendTo___________training';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'notes' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
					'task_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
					'body' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb4_bin', 'charset' => 'utf8mb4'),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_bin', 'engine' => 'MyISAM'),
				),
				'tasks' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'body' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
					'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
					'file_path' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_bin', 'charset' => 'utf8mb4'),
					'due_date' => array('type' => 'date', 'null' => true, 'default' => null),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM'),
				),
				'users' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
					'password' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb4_bin', 'charset' => 'utf8mb4'),
					'email' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb4_bin', 'charset' => 'utf8mb4'),
					'indexes' => array(
						'users_1' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_bin', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'notes', 'tasks', 'users'
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
