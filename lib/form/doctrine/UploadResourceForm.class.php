<?php

/**
 * Resource form.
 *
 * @package    xliffeditor
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UploadResourceForm extends sfFormDoctrine
{
    public function configure()
    {
        $this->widgetSchema['file'] = new sfWidgetFormInputFile();
        $q = ProjectLanguageTable::getInstance()->createQuery('pl')->addWhere('pl.project_id = ?', $this->getObject()->project_id);
        $this->widgetSchema['language'] = new sfWidgetFormDoctrineChoice(array(
                                                                              'model' => 'ProjectLanguage',
                                                                              'query' => $q
                                                                         ));

        $this->validatorSchema['file'] = new sfValidatorFile();
        $this->validatorSchema['language'] = new sfValidatorDoctrineChoice(array(
                                                                                'model' => 'ProjectLanguage',
                                                                                'query' => $q
                                                                           ));

        $this->widgetSchema->setNameFormat('resource[%s]');

    }

    public function getName()
    {
        return 'resource';
    }

    public function getModelName()
    {
        return 'Resource';
    }

    public function save($con = null)
    {
        $values = $this->getValues();
        $file = $values['file'];
        $languageId = $values['language'];

        $language = ProjectLanguageTable::getInstance()->find($languageId);

        $importer = new XliffResourceFileImporter($this->getObject());
        $result = $importer->importFile($file->getTempName(), $language);

        return $result;

    }
}
