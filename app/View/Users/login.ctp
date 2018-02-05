<h2>Fazer Login</h2>
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('email', array('type' => 'email')); ?>
<?php echo $this->Form->input('password', array('type' => 'password')); ?>
<?php echo $this->Form->end('Entrar'); ?>

