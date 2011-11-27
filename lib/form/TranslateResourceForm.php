<?php 

class TranslateResourceForm extends sfForm
{

    protected $resource, $language;

    public function __construct(Resource $resource, ProjectLanguage $language)
    {
        $this->resource = $resource;
        $this->language = $language;
        parent::__construct();
    }

    public function setup()
    {
        $isBaseLanguage = $this->resource->base_language_id == $this->language->id;
        foreach ($this->resource->Lines as $line) {
            $name = $line->id;
            $value = $line->getTargetText($this->language->lang, '');

            $widget = new sfWidgetFormInputText(array('label' => $line->source_text, 'default' => $value));
            $validator = new sfValidatorString(array('required' => false));

            if ($isBaseLanguage) {
                $widget->setAttribute('placeholder', $line->source_text);
            }

            $this->setWidget($name, $widget);
            $this->setValidator($name, $validator);
        }

        $this->widgetSchema->setNameFormat('labels[%s]');
    }

    public function getName() {
        return 'labels';
    }

    public function save() {

        $values = $this->getValues();

        $this->resource->setTranslations($this->language, $values);

    }

}
