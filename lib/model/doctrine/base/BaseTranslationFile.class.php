<?php

/**
 * BaseTranslationFile
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $project_id
 * @property string $name
 * @property string $filename
 * @property TranslationProject $Project
 * 
 * @method integer            getId()         Returns the current record's "id" value
 * @method integer            getProjectId()  Returns the current record's "project_id" value
 * @method string             getName()       Returns the current record's "name" value
 * @method string             getFilename()   Returns the current record's "filename" value
 * @method TranslationProject getProject()    Returns the current record's "Project" value
 * @method TranslationFile    setId()         Sets the current record's "id" value
 * @method TranslationFile    setProjectId()  Sets the current record's "project_id" value
 * @method TranslationFile    setName()       Sets the current record's "name" value
 * @method TranslationFile    setFilename()   Sets the current record's "filename" value
 * @method TranslationFile    setProject()    Sets the current record's "Project" value
 * 
 * @package    xliffeditor
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTranslationFile extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('translation_file');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('project_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('name', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('filename', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('TranslationProject as Project', array(
             'local' => 'project_id',
             'foreign' => 'id'));
    }
}