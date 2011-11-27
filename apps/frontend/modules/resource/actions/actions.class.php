<?php

/**
 * resource actions.
 *
 * @package    xliffeditor
 * @subpackage resource
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class resourceActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeShow(sfWebRequest $request)
    {
        $this->resource = $this->getRoute()->getObject();
        $this->project = $this->resource->getProject();
    }

    public function executeManage(sfWebRequest $request)
    {
        $this->resource = $this->getRoute()->getObject();
        $this->project = $this->resource->getProject();

        $this->form = $form = new ResourceForm($this->resource);

        if ($request->isMethod('POST')) {
            $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

            if ($form->isValid()) {
                $form->save();
                $this->redirect('resource', $this->resource);
            }
        }
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->resource = $this->getRoute()->getObject();
        $this->project = $this->resource->getProject();

        $this->form = $form = new UploadResourceForm($this->resource);

        if ($request->isMethod('PUT')) {
            $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

            if ($form->isValid()) {
                $form->save();
                $this->redirect('resource', $this->resource);
            }
        }
    }

    public function executeDownload(sfWebRequest $request)
    {
        $this->resource = $this->getRoute()->getObject();
        $this->project = $this->resource->getProject();

        $this->langCode = $request->getParameter('lang');
        $this->language = $this->project->getLanguage($this->langCode);

        $exporter = new XliffResourceFileExporter($this->resource);
        return $exporter->exportToResponse($this->language, $this->getResponse());
    }

    public function executeTranslate(sfWebRequest $request)
    {
        $this->resource = $this->getRoute()->getObject();
        $this->project = $this->resource->getProject();
        $this->langCode = $request->getParameter('lang');
        $this->language = $this->project->getLanguage($this->langCode);

        $this->form = $form = new TranslateResourceForm($this->resource, $this->language);

        if ($request->isMethod('POST')) {
            $form->bind($request->getParameter($form->getName()));

            if ($form->isValid()) {
                $form->save();
            }
        }
    }

}
