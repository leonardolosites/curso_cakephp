<div class="products form">
<?php echo $this->Form->create('Product'); ?>
	<fieldset>
		<legend><?php echo __('Adicionar Produto'); ?></legend>
	<?php
		echo $this->Form->input('title', array('label' => 'Descrição'));
		echo $this->Form->input('price', array('label' => 'Preço'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Salvar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Lista de Produtos'), array('action' => 'index')); ?></li>
	</ul>
</div>
