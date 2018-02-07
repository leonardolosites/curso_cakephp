<div class="products index">
    <h2>Carrinho de Compras</h2>
    <?php echo $this->Form->create('Product', array('url' => 'atualiza_carrinho'));?>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Código'); ?></th>
            <th><?php echo $this->Paginator->sort('Descrição'); ?></th>
            <th><?php echo $this->Paginator->sort('Preço'); ?></th>
            <th><?php echo $this->Paginator->sort('Quantidade'); ?></th>
            <th><?php echo $this->Paginator->sort('Total'); ?></th>
            <th class="actions"><?php echo __('Ações'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $n = 0;
        foreach ($carrinho as $product): ?>
            <tr>
                <td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
                <td><?php echo h($product['Product']['title']); ?>&nbsp;</td>
                <td><?php echo h($product['Product']['price']); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Form->hidden("Carrinho.{$n}.id", array('value' => $product['Product']['id'])); ?>
                    <?php echo $this->Form->text("Carrinho.{$n}.quantity", array('value' => $product['Product']['quantity'], 'style' => 'width:50px', 'type' => 'number')); ?>
                </td>
                <td><?php echo h($product['Product']['quantity'] * $product['Product']['price']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Remover do Carrinho'), array('action' => 'remover_carrinho', $product['Product']['id'])); ?>
                </td>
            </tr>
            <?php
            $n++;
        endforeach; ?>

        </tbody>
    </table>
    <?php
    if($n > 0){
        echo $this->Form->submit('Atualizar Carrinho');
    }
    ?>
    <?php
    if($n > 0):
    echo $this->Form->end(); ?>

    <form method="post" target="pagseguro" action="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html">

        <!-- Campos obrigatórios -->
        <?php echo $this->Form->hidden(null, array('name' => 'receiverEmail', 'value' => 'adsleonardo.o@gmail.com'))?>
        <?php echo $this->Form->hidden(null, array('name' => 'currency', 'value' => 'BRL'))?>
        <?php echo $this->Form->hidden(null, array('name' => 'encoding', 'value' => 'UTF-8'))?>

        <!-- Itens do pagamento (ao menos um item é obrigatório) -->
        <?php $n = 1; foreach ($carrinho as $product): ?>
            <?php echo $this->Form->hidden(null, array('name' => 'itemId'.$n, 'value' => $product['Product']['id']))?>
            <?php echo $this->Form->hidden(null, array('name' => 'itemDescription'.$n, 'value' => $product['Product']['title']))?>
            <?php echo $this->Form->hidden(null, array('name' => 'itemAmount'.$n, 'value' => $product['Product']['price']))?>
            <?php echo $this->Form->hidden(null, array('name' => 'itemQuantity'.$n, 'value' => $product['Product']['quantity']))?>
            <?php $n++; endforeach ?>
        <!-- submit do form (obrigatório) -->
        <input alt="Pague com PagSeguro" name="submit" type="image" style="width:120px" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/120x53-pagar.gif"/>

    </form>
    <?php endif; ?>
    <br><br><br>
    <h2><?php echo __('Products'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Código'); ?></th>
            <th><?php echo $this->Paginator->sort('Descrição'); ?></th>
            <th><?php echo $this->Paginator->sort('Preço'); ?></th>
            <th><?php echo $this->Paginator->sort('Data de Cadastro'); ?></th>
            <th class="actions"><?php echo __('Ações'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
                <td><?php echo h($product['Product']['title']); ?>&nbsp;</td>
                <td><?php echo h($product['Product']['price']); ?>&nbsp;</td>
                <td><?php echo h($this->Time->format('d/m/Y', $product['Product']['created'])); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Adiconar no Carrinho'), array('action' => 'adicionar_carrinho', $product['Product']['id'])); ?>
                    <?php echo $this->Html->link(__('Detalhes'), array('action' => 'view', $product['Product']['id'])); ?>
                    <?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $product['Product']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $product['Product']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['Product']['id']))); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
                                           'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                                       ));
        ?>	</p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Novo Produto'), array('action' => 'add')); ?></li>
    </ul>
</div>
