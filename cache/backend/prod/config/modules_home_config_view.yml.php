<?php
// auto-generated by sfViewConfigHandler
// date: 2016/03/11 17:14:23
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $this->setComponentSlot('sf_twitter_bootstrap_permanent_slot', '', '');
  if (sfConfig::get('sf_logging_enabled')) $this->context->getEventDispatcher()->notify(new sfEvent($this, 'application.log', array(sprintf('Set component "%s" (%s/%s)', 'sf_twitter_bootstrap_permanent_slot', '', ''))));
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('/sfTwitterBootstrapPlugin/bootstrap-32-dist/css/bootstrap.min.css', '', array ());
  $response->addStylesheet('/sfTwitterBootstrapPlugin/bootstrap-32-dist/css/bootstrap-theme.min.css', '', array (  'media' => 'print ,screen',));
  $response->addStylesheet('/sfTwitterBootstrapPlugin/css/style.css', '', array ());
  $response->addStylesheet('/sfTwitterBootstrapPlugin/css/bootstrap-datetimepicker.min.css', '', array ());
  $response->addStylesheet('/sfTwitterBootstrapPlugin/css/bootstrap-select.min.css', '', array ());
  $response->addStylesheet('menu.css', '', array ());
  $response->addJavascript('/sfTwitterBootstrapPlugin/js/jquery-1.9.1.min.js', '', array ());
  $response->addJavascript('/sfTwitterBootstrapPlugin/js/application.js', '', array ());
  $response->addJavascript('/sfTwitterBootstrapPlugin/js/bootbox/bootbox.min.js', '', array ());
  $response->addJavascript('/sfTwitterBootstrapPlugin/bootstrap-32-dist/js/bootstrap.min.js', '', array ());
  $response->addJavascript('/sfTwitterBootstrapPlugin/js/bootstrap-datetimepicker.min.js', '', array ());
  $response->addJavascript('/sfTwitterBootstrapPlugin/js/bootstrap-select.min.js', '', array ());
  $response->addJavascript('menu.js', '', array ());


