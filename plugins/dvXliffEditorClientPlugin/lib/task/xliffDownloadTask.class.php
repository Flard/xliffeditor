<?php

class xliffDownloadTask extends xliffTaskBase
{
    protected function configure()
    {
        // // add your own arguments here
        $this->addArguments(array(
                                 new sfCommandArgument('application', sfCommandArgument::REQUIRED, 'frontend'),
//                                 new sfCommandArgument('resource', sfCommandArgument::REQUIRED, 'Resource ID'),
//                                 new sfCommandArgument('language', sfCommandArgument::REQUIRED, 'Language'),
//                                 new sfCommandArgument('path', sfCommandArgument::REQUIRED, 'Path to xliff'),
                            ));

        $this->addOptions(array(
//                               new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
//                               new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
//                               new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
                               // add your own options here
                          ));

        $this->namespace = 'xliff';
        $this->name = 'download';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [xliff:download|INFO] task downloads translation catalogs.
Call it with:

  [php symfony xliff:download|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
        // Initialize client
        $this->client = $client = XliffEditorClient::fromConfig();

        $this->logSection('xliff', 'Retrieving project info');
        $projectInfo = $client->getProjectInfo();

        $languages = array();
        foreach($projectInfo->languages as $langCode => $name) {
            $languages[] = $langCode;
        }

        foreach($projectInfo->resources as $resource) {
            foreach($resource->languages as $langCode => $lineCount) {
                if ($lineCount == 0) continue;

                $this->downloadResource($resource, $langCode);
            }
        }
    }

    protected function downloadResource($resourceInfo, $lang) {
        $catalogue = $resourceInfo->catalogue;
        $this->logSection('xliff', 'Downloading '.$catalogue.' ('.$lang.')');

        $targetPath = sfConfig::get('sf_app_dir').'/i18n/'.$lang.'/'.$catalogue.'.xml';
        $contents = $this->client->downloadFile($catalogue, $lang);

        if (empty($contents)) {
            return;
        }

        $dirName = dirname($targetPath);
        if (!file_exists($dirName)) {
            mkdir($dirName, 0777, true);
        }

        $this->logSection('file', $targetPath);
        file_put_contents($targetPath, $contents);
    }
}
