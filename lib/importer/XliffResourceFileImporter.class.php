<?php

class XliffResourceFileImporter extends BaseResourceFileImporter
{

    protected $resource, $options;

    public function __construct(Resource $resource, $options)
    {
        $this->resource = $resource;
        $this->options = $options;
    }

    public function importFile($path, ProjectLanguage $language)
    {
        $translations = $this->loadTranslations($path);
        foreach($translations as $sourceText => $translation) {

            list($targetText, $targetId, $targetNote) = $translation;
            
            $this->resource->setTranslation($language, $sourceText, $targetText, $targetNote);

        }
    }

    protected function loadTranslations($filename)
    {
        libxml_use_internal_errors(true);
        if (!$xml = simplexml_load_file($filename)) {
            $error = false;

            return $error;
        }
        libxml_use_internal_errors(false);

        $translationUnit = $xml->xpath('//trans-unit');

        $translations = array();

        foreach ($translationUnit as $unit)
        {
            $source = (string)$unit->source;
            $translations[$source][] = (string)$unit->target;
            $translations[$source][] = (string)$unit['id'];
            $translations[$source][] = (string)$unit->note;
        }

        return $translations;
    }

}
