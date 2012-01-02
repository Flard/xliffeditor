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

    public function executeInfo(sfWebRequest $request) {
        // Process input
        $token = $request->getParameter('token');
        if (empty($token)) { throw new sfApiException('Please provide a token'); }

        // Find project
        $project = ProjectTable::getInstance()->findOneByToken($token);
        if ($project === FALSE) { throw new sfApiException('No project found for token');}

        $result = $project->toArray(true);
        unset($result['id']);
        $result['url'] = $this->generateUrl('project', $project, true);

        $result['languages'] = array();
        $languages = array();
        foreach($project->Languages as $language) {
            $result['languages'][$language->lang] = $language->name;
            $languages[] = $language->lang;
        }

        $result['resources'] = array();
        foreach($project->Resources as $resource) {
            $resourceLines = array();
            foreach($project->Languages as $language) {
                $resourceLines[$language->lang] = $resource->getTranslatedLineCount($language);
            }

            $resourceArray = array(
                'name' => $resource->name,
                'catalogue' => $resource->catalogue,
                'languages' => $resourceLines
            );

            $result['resources'][] = $resourceArray;
        }

        return $this->renderData($result);
    }

    public function executeDownload(sfWebRequest $request) {
        // Process input
        $token = $request->getParameter('token');
        if (empty($token)) { throw new sfApiException('Please provide a token'); }

        $resourceName = $request->getParameter('resource_name');
        if (empty($resourceName)) { throw new sfApiException('Please add a resource name'); }

        $langcode = $request->getParameter('language');
        if (empty($langcode)) { throw new sfApiException('Please add a language identifier'); }

        // Find project
        $project = ProjectTable::getInstance()->findOneByToken($token);
        if ($project === FALSE) { throw new sfApiException('No project found for token');}

        $resource = $project->getResource($resourceName);
        if ($resource === FALSE) { throw new sfApiException('Resource not found'); }

        $language = $project->getLanguage($langcode);
        if ($language === FALSE) { throw new sfApiException('Language not found'); }

        $exporter = new XliffResourceFileExporter($resource);
        return $exporter->exportToResponse($language, $this->getResponse());
    }

    protected function renderData($result)
    {
        $json = json_encode($result);
        $this->getResponse()->setContentType('application/json');
        return $this->renderText($json);
    }
}
