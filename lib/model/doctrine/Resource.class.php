<?php

/**
 * Resource
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    xliffeditor
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Resource extends BaseResource
{
    public function getProjectSlug()
    {
        return $this->Project->slug;
    }

    public function getTotalLineCount()
    {
        $q = ResourceLineTable::getInstance()->createQuery('l')
                ->select('COUNT(l.id)')->where('l.resource_id = ?', $this->id);
        return $q->fetchOne(null, Doctrine_Core::HYDRATE_SINGLE_SCALAR);
    }

    public function getTranslatedLineCount($language = null)
    {
        $q = ResourceLineTranslationTable::getInstance()->createQuery('lr')
                ->select('COUNT(lr.line_id)')
                ->where('lr.line_id IN (SELECT l.id FROM ResourceLine l WHERE l.resource_id = ?)', $this->id);
        if ($language !== null) {
            $q->andWhere('lr.language_id = ?', $language->id);
        }
        return $q->fetchOne(null, Doctrine_Core::HYDRATE_SINGLE_SCALAR);
    }

    public function getPercentageComplete($language = null)
    {
        $linesToTranslate = $this->getTotalLineCount();

        if ($language === null) {
            $languageCount = $this->Project->getLanguageCount();
            $linesToTranslate = $linesToTranslate * $languageCount;
        }

        if ($linesToTranslate == 0) return 0;
        $linesTranslated = $this->getTranslatedLineCount($language);

        return (100 / $linesToTranslate) * $linesTranslated;
    }

    public function setTranslation($language, $sourceText, $targetText, $note)
    {

        $line = $this->findLineBySourceText($sourceText);
        if ($line === FALSE) {
            $line = new ResourceLine();
            $line->resource_id = $this->id;
            $line->source_text = $sourceText;
            $line->remarks = $note;
            $line->save();
        }

        if (!empty($targetText)) {
            $line->setTranslation($language, $targetText);
        }
    }

    public function setTranslations(ProjectLanguage $language, $values)
    {
        $languageId = $language->id;

        foreach ($values as $lineId => $targetText) {
            $line = $this->findLineById($lineId);
            $line->setTranslation($languageId, $targetText);
        }
    }

    protected function findLineBySourceText($sourceText)
    {
        $lines = $this->getLines();
        foreach ($lines as $line) {
            if ($line->source_Text == $sourceText) {
                return $line;
            }
        }
        return false;
    }

    protected function findLineById($lineId)
    {
        $lines = $this->getLines();
        foreach ($lines as $line) {
            if ($line->id == $lineId) {
                return $line;
            }
        }
        return false;
    }
}
