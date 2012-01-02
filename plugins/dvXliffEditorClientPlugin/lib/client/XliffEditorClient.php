<?php
/**
 * Created by JetBrains PhpStorm.
 * User: grad
 * Date: 1/2/12
 * Time: 9:08 PM
 * To change this template use File | Settings | File Templates.
 */
class XliffEditorClient
{
    protected $apiAddress;
    protected $token;

    public function __construct($apiAddress, $token) {

        $this->apiAddress = $apiAddress;
        $this->token = $token;

    }

    public static function fromConfig($path = null) {

        if (empty($path)) {
            $path = sfConfig::get('sf_config_dir').'/xliffeditor.yml';
        }

        $config =       sfYaml::load($path);

        $apiAddress =   $config['client']['address'];
        $token =        $config['client']['token'];

        return new XliffEditorClient($apiAddress, $token);
    }

    protected $dispatcher, $formatter;
    public function assignDispatcher(sfEventDispatcher $dispatcher, sfFormatter $formatter) {
        $this->dispatcher = $dispatcher;
        $this->formatter = $formatter;
    }

    protected function getCurl($endPoint) {

        $url = $this->apiAddress.$endPoint;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "dvXliffEditorClientPlugin 1.0");
        curl_setopt($ch, CURLOPT_URL, $url);


        return $ch;
    }

    public function uploadFile($filePath, $resourceName, $language) {

        $ch = $this->getCurl('/upload');
        curl_setopt($ch, CURLOPT_POST, true);
        $post = array(
            'file' => "@$filePath",
            'token' => $this->token,
            'resource_name' => $resourceName,
            'language' => $language
       );
       curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }

    public function downloadFile($resourceName, $language) {
        $getFields = array(
            'token' => $this->token,
            'resource_name' => $resourceName,
            'language' => $language
        );
        $getFields = http_build_query($getFields);

        $ch = $this->getCurl('/download?'.$getFields);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function getProjectInfo() {
        $ch = $this->getCurl('/info?token='.$this->token);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }
}
