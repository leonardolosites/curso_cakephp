<div class="products form">
<?php echo $this->Form->create('Product'); ?>
	<fieldset>
		<legend><?php echo __('Editar Produto'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title', array('label' => 'Descrição'));
		echo $this->Form->input('price', array('label' => 'Preço'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $this->Form->value('Product.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Product.id')))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Produtos'), array('action' => 'index')); ?></li>
	</ul>
</div>