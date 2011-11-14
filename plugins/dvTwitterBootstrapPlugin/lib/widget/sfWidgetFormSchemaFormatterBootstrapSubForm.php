<?php
/**
 * Created by JetBrains PhpStorm.
 * User: van Horck
 * Date: 1-11-11
 * Time: 18:10
 * To change this template use File | Settings | File Templates.
 */
 
class sfWidgetFormSchemaFormatterBootstrapSubForm extends sfWidgetFormSchemaFormatterBootstrap {

    protected
//        $rowFormat       = "\n  <label>%label%</label>\n  %error%%field%%help%\n%hidden_fields%\n",
        $decoratorFormat = "<fieldset>%content%</fieldset>";
}
