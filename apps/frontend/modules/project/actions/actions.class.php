<?php

/**
 * project actions.
 *
 * @package    xliffeditor
 * @subpackage project
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class projectActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $this->projects = $this->getUser()->getProjects();
  }

  public function executeShow(sfWebRequest $request) {
    $this->project = $this->getRoute()->getObject();
  }
}