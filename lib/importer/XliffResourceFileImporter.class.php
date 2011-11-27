<?php

class XliffResourceFileImporter extends BaseResourceFileImporter
{

    protected $resource, $options;

    public function __construct(Resource $resource, $options = array())
    {
        $this->resource = $resource;
        $this->options = $options;
    }

    public function importFile($path, ProjectLanguage $language)
    {
        $this->loadDom($path);

//        if ($language = null) {
//            $this->determineLanguage();
//        }

        $translations = $this->loadTranslations();
        foreach($translations as $sourceText => $translation) {

            list($targetText, $targetId, $targetNote) = $translation;
            
            $this->resource->setTranslation($language, $sourceText, $targetText, $targetNote);

        }
    }
    protected function loadDom($path) {
        libxml_use_internal_errors(true);
        if (!$xml = simplexml_load_file($path)) {
            $error = false;

            return $error;
        }
        libxml_use_internal_errors(false);
        $this->dom = $xml;
    }

    protected function determineLanguage() {
        $xml = $this->dom;
        
    }

    protected function loadTranslations()
    {
        $xml = $this->dom;
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
