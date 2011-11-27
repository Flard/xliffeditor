<?php

/**
 * BaseResource
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $project_id
 * @property string $name
 * @property string $catalogue
 * @property integer $base_language_id
 * @property Project $Project
 * @property ProjectLanguage $BaseLanguage
 * @property Doctrine_Collection $Lines
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method integer             getProjectId()        Returns the current record's "project_id" value
 * @method string              getName()             Returns the current record's "name" value
 * @method string              getCatalogue()        Returns the current record's "catalogue" value
 * @method integer             getBaseLanguageId()   Returns the current record's "base_language_id" value
 * @method Project             getProject()          Returns the current record's "Project" value
 * @method ProjectLanguage     getBaseLanguage()     Returns the current record's "BaseLanguage" value
 * @method Doctrine_Collection getLines()            Returns the current record's "Lines" collection
 * @method Resource            setId()               Sets the current record's "id" value
 * @method Resource            setProjectId()        Sets the current record's "project_id" value
 * @method Resource            setName()             Sets the current record's "name" value
 * @method Resource            setCatalogue()        Sets the current record's "catalogue" value
 * @method Resource            setBaseLanguageId()   Sets the current record's "base_language_id" value
 * @method Resource            setProject()          Sets the current record's "Project" value
 * @method Resource            setBaseLanguage()     Sets the current record's "BaseLanguage" value
 * @method Resource            setLines()            Sets the current record's "Lines" collection
 * 
 * @package    xliffeditor
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseResource extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('resource');
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
        $this->hasColumn('catalogue', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('base_language_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Project', array(
             'local' => 'project_id',
             'foreign' => 'id'));

        $this->hasOne('ProjectLanguage as BaseLanguage', array(
             'local' => 'base_language_id',
             'foreign' => 'id'));

        $this->hasMany('ResourceLine as Lines', array(
             'local' => 'id',
             'foreign' => 'resource_id'));
    }
}