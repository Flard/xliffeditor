<?php

/**
 * ProjectLanguage form.
 *
 * @package    xliffeditor
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProjectLanguageForm extends BaseProjectLanguageForm
{
  public function configure()
  {
      $this->useFields(array('name', 'lang'));
      
      //$this->widgetSchema['lang'] = new sfWidgetFormI18nChoiceLanguage();
      
      $this->widgetSchema->setLabels(array(
          'name' => 'Display name',
          'lang' => 'Language code'
          ));
          
      $this->widgetSchema->setHelp('lang', 'Enter the two-character language code');
  }
}
