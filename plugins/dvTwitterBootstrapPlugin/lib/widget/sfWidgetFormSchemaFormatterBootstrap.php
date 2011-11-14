<?php
/**
 * Created by JetBrains PhpStorm.
 * User: van Horck
 * Date: 1-11-11
 * Time: 18:10
 * To change this template use File | Settings | File Templates.
 */
 
class sfWidgetFormSchemaFormatterBootstrap extends sfWidgetFormSchemaFormatter {

    protected
        $rowFormat       = "<div class=\"clearfix%extra_classes%\">\n  %label%\n  <div class=\"input\">%field%%error%%help%</div>\n%hidden_fields%</div>\n",
        $errorRowFormat  = "<li>\n%errors%</li>\n",
        $helpFormat      = '<span class="help-block">%help%</span>',
        $errorListFormatInARow = '<span class="help-inline">%errors%</span>',
        $errorRowFormatInARow = '%error%',
        $decoratorFormat = "%content%";

    public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
    {
        if (count($errors) > 0) {
            $extraClasses = ' error';
        } else {
            $extraClasses = '';
        }

        return strtr($this->getRowFormat(), array(
          '%extra_classes%' => $extraClasses,
          '%label%'         => $label,
          '%field%'         => $field,
          '%error%'         => $this->formatErrorsForRow($errors),
          '%help%'          => $this->formatHelp($help),
          '%hidden_fields%' => null === $hiddenFields ? '%hidden_fields%' : $hiddenFields,
        ));
    }
}
