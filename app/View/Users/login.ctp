<h1>Login</h1>
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('email'); ?>
<?php echo $this->Form->input('password', array('type' => 'password')); ?>
<?php echo $this->Form->button('Login'); ?>
<?php echo $this->Form->end(); ?>

<?php echo $this->Html->link('Register', array('controller' => 'users', 'action' => 'register')); ?>