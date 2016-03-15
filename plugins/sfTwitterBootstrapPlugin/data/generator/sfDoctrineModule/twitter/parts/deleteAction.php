  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if ($this->getRoute()->getObject()->delete()) {
      $this->getUser()->setFlash('notice', 'Бичлэгийг амжилттай устгалаа.');
    }

    $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
  }
