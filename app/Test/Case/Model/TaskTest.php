<?php
App::uses('Task', 'Model');

class TaskTest extends CakeTestCase {

    // 使用するフィクスチャを定義
    public $fixtures = array('app.task', 'app.note');

    // Taskモデルのインスタンスを初期化
    public function setUp() {
        parent::setUp();
        $this->Task = ClassRegistry::init('Task');
    }

    // タスク名のバリデーションテスト (空白や長すぎる名前のチェック)
    public function testValidationName() {
        // 空のタスク名
        $data = array('Task' => array('name' => '', 'body' => 'Some body text'));
        $this->Task->set($data);
        $this->assertFalse($this->Task->validates(), 'タスク名が空でも通過しています。');

        // タスク名が長すぎる
        $data = array('Task' => array('name' => str_repeat('a', 61), 'body' => 'Some body text'));
        $this->Task->set($data);
        $this->assertFalse($this->Task->validates(), 'タスク名が60文字を超えても通過しています。');
    }

    // 詳細のバリデーションテスト (空白や長すぎる詳細のチェック)
    public function testValidationBody() {
        // 空の詳細
        $data = array('Task' => array('name' => 'Sample Task', 'body' => ''));
        $this->Task->set($data);
        $this->assertFalse($this->Task->validates(), '詳細が空でも通過しています。');

        // 詳細が255文字を超えないか
        $data = array('Task' => array('name' => 'Sample Task', 'body' => str_repeat('a', 256)));
        $this->Task->set($data);
        $this->assertFalse($this->Task->validates(), '詳細が255文字を超えても通過しています。');
    }

    // ファイル拡張子のバリデーションテスト
    public function testValidationFile() {
        // 有効な拡張子
        $data = array('Task' => array('name' => 'Sample Task', 'body' => 'Sample body', 'file' => 'file.jpg'));
        $this->Task->set($data);
        $this->assertTrue($this->Task->validates(), '有効なファイル拡張子でも通過しませんでした。');

        // 無効な拡張子
        $data = array('Task' => array('name' => 'Sample Task', 'body' => 'Sample body', 'file' => 'file.exe'));
        $this->Task->set($data);
        $this->assertFalse($this->Task->validates(), '無効なファイル拡張子が通過しています。');
    }

    // Taskモデルのインスタンスを削除
    public function tearDown() {
        unset($this->Task);
        parent::tearDown();
    }
}
