<?php

/**
 * resource actions.
 *
 * @package    xliffeditor
 * @subpackage resource
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class resourceActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeShow(sfWebRequest $request)
  {
    $this->resource = $this->getRoute()->getObject();
	$this->project = $this->resource->getProject();
  }
}
