<?php

class xliffUploadTask extends xliffTaskBase
{
    protected function configure()
    {
        // // add your own arguments here
        $this->addArguments(array(
//                                 new sfCommandArgument('project', sfCommandArgument::REQUIRED, 'Project ID'),
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
        $this->name = 'upload';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [xliff:upload|INFO] task uploads translation catalogs.
Call it with:

  [php symfony xliff:upload|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
        // Initialize client
        $client = XliffEditorClient::fromConfig();
        $client->assignDispatcher($this->dispatcher, $this->formatter);

        // Determine files
        $files = $this->getAvailableCatalogs();
        foreach($files as $file) {

            $path = $file['path'];
            $resourceName = $file['resource_name'];
            $language = $file['language'];

            $result =$client->uploadFile($path, $resourceName, $language);
            var_dump($result);
        }
    }
}
