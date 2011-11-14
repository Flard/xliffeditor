<?php
/**
 * Created by JetBrains PhpStorm.
 * User: van Horck
 * Date: 1-11-11
 * Time: 18:10
 * To change this template use File | Settings | File Templates.
 */
 
class sfWidgetFormSchemaFormatterBootstrapSubForms extends sfWidgetFormSchemaFormatterBootstrap {

    protected
        $rowFormat       = "\n  <legend>%label%</legend>\n  %error%%field%%help%\n%hidden_fields%\n";
}
