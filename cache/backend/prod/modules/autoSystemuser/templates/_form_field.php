<?php if ($field->isPartial()): ?>
  <?php include_partial('systemuser/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
  <?php include_component('systemuser', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
  <div class="control-group col-md-4 form-group <?php echo $class ?><?php $form[$name]->hasError() and print ' error' ?>">

    <?php echo $form[$name]->renderLabel($label) ?>

    <div class="controls">
      <?php echo $form[$name]->renderError() ?>
      <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>

      <?php if ($help): ?>
        <p class="help-block"><?php echo __(html_entity_decode($help), array(), 'messages') ?></p>
      <?php elseif ($help = $form[$name]->renderHelp()): ?>
        <p class="help-block"><?php echo $help ?></p>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>
