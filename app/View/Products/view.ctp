<div class="products view">
<h2><?php echo __('Produto'); ?></h2>
	<dl>
		<dt><?php echo __('Código'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descrição'); ?></dt>
		<dd>
			<?php echo h($product['Product']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Preço'); ?></dt>
		<dd>
			<?php echo h($product['Product']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data de Cadastro'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('d/m/Y', $product['Product']['created'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Produto'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar Produto'), array('action' => 'delete', $product['Product']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['Product']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Produtos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo Produto'), array('action' => 'add')); ?> </li>
	</ul>
</div>
