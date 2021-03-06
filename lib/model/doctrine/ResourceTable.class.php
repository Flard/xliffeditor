<?php

/**
 * ResourceTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ResourceTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ResourceTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Resource');
    }

    public function retrieveForRouting($params) {
        $q = $this->createQuery('r')
                ->leftJoin('r.Project p')
                ->where('r.catalogue = ?', $params['catalogue'])
                ->addWhere('p.slug = ?', $params['projectSlug'])
                ;

        return $q->execute();
    }
}