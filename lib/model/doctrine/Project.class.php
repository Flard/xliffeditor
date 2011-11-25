<?php

/**
 * Project
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    xliffeditor
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Project extends BaseProject
{
    public function getFileCount()
    {
        $q = ResourceTable::getInstance()->createQuery('r')->select('COUNT(r.id)')->where('r.project_id = ?', $this->id);
        return $q->fetchOne(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
    }

    public function getLanguageCount()
    {
        $q = ProjectLanguageTable::getInstance()->createQuery('l')->select('COUNT(l.id)')->where('l.project_id = ?', $this->id);
        return $q->fetchOne(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
    }

    protected function getTotalLineCount() {
        $q = ResourceLineTable::getInstance()->createQuery('l')
              ->select('COUNT(l.id)')
              ->where('l.resource_id IN (SELECT r.id FROM Resource r WHERE r.project_id = ?)', $this->id);

        return $q->fetchOne(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
    }

    protected function getTotalTranslatedLineCount() {
        $q = ResourceLineTranslationTable::getInstance()->createQuery('lt')
              ->select('COUNT(lt.line_id)')
              ->where('lt.line_id IN (SELECT l.id FROM ResourceLine l WHERE l.resource_id IN (SELECT r.id FROM Resource r WHERE r.project_id = ?))', $this->id);

        return $q->fetchOne(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
    }

    public function getPercentageComplete()
    {
        $totalLineCount = $this->getTotalLineCount();
        $totalLanguages = $this->getLanguageCount();

        $linesToBeTranslated = $totalLineCount * $totalLanguages;
        $linesTranslated = $this->getTotalTranslatedLineCount();

        if ($linesToBeTranslated == 0) return 0;

        return (100 / $linesToBeTranslated) * $linesTranslated;
    }

    public function getLanguage($langCode)
    {
        foreach ($this->Languages as $language) {
            if ($language->lang == $langCode) {
                return $language;
            }
        }
        return false;
    }
}
