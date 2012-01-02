<?php

/**
 * api actions.
 *
 * @package    xliffeditor
 * @subpackage api
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class apiActions extends sfActions
{
    public function executeUpload(sfWebRequest $request)
    {
        // Process input
        $token = $request->getParameter('token');
        if (empty($token)) { throw new sfApiException('Please provide a token'); }

        $resourceName = $request->getParameter('resource_name');
        if (empty($resourceName)) { throw new sfApiException('Please add a resource name'); }

        $langcode = $request->getParameter('language');
        if (empty($langcode)) { throw new sfApiException('Please add a language identifier'); }

        $fileInfo = $request->getFiles('file');
        if (empty($fileInfo)) { throw new sfApiException('No file provided'); }

        // Find project
        $project = ProjectTable::getInstance()->findOneByToken($token);
        if ($project === FALSE) { throw new sfApiException('No project found for token');}

        $resource = $project->getResource($resourceName);
        if ($resource === FALSE) { throw new sfApiException('Resource not found'); }

        $language = $project->getLanguage($langcode);
        if ($language === FALSE) { throw new sfApiException('Language not found'); }

        $importOptions = array();
        $importer = new XliffResourceFileImporter($resource, $importOptions);

        $path = $fileInfo['tmp_name'];
        $importer->importFile($path, $language);

        $result = array('success' => 'true');
        return $this->renderData($result);
    }

    protected function renderData($result)
    {
        $json = json_encode($result);
        $this->getResponse()->setContentType('application/json');
        return $this->renderText($json);
    }
}
