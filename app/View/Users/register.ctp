<h1>Register</h1>
<?php echo $this->Form->create('User'); ?>
    <?php echo $this->Form->input('email'); ?>
    <?php echo $this->Form->input('password', array('type' => 'password')); ?>
    <?php echo $this->Form->button('Register'); ?>
<?php echo $this->Form->end(); ?>