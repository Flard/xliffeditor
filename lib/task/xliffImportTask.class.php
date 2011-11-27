<?php

class xliffImportTask extends sfBaseTask
{
    protected function configure()
    {
        // // add your own arguments here
        $this->addArguments(array(
                                 new sfCommandArgument('project', sfCommandArgument::REQUIRED, 'Project ID'),
                                 new sfCommandArgument('resource', sfCommandArgument::REQUIRED, 'Resource ID'),
                                 new sfCommandArgument('language', sfCommandArgument::REQUIRED, 'Language'),
                                 new sfCommandArgument('path', sfCommandArgument::REQUIRED, 'Path to xliff'),
                            ));

        $this->addOptions(array(
                               new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
                               new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
                               new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
                               // add your own options here
                          ));

        $this->namespace = 'xliff';
        $this->name = 'import';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [xliff:import|INFO] task does things.
Call it with:

  [php symfony xliff:import|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        // Load Project
        $projectId = $arguments['project'];
        $project = ProjectTable::getInstance()->find($projectId);

        $resourceId = $arguments['resource'];
        $resource = ResourceTable::getInstance()->find($resourceId);

        $langCode = $arguments['language'];
        $language = $project->getLanguage($langCode);

        $path = $arguments['path'];
        if (!file_exists($path)) {
            $path = getcwd().DIRECTORY_SEPARATOR.$path;
        }
        $options = array();

        $importer = new XliffResourceFileImporter($resource, $options);
        $importer->importFile($path, $language);
    }
}
