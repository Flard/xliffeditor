<?php

class xliffMergeCsvTask extends sfBaseTask
{
    protected function configure()
    {
        // // add your own arguments here
        $this->addArguments(array(
                                 new sfCommandArgument('input_xliff', sfCommandArgument::REQUIRED, 'Input XLIFF file (xml)'),
                                 new sfCommandArgument('input_csv', sfCommandArgument::REQUIRED, 'Input CSV file'),
                                 new sfCommandArgument('output_xliff', sfCommandArgument::REQUIRED, 'Output XLIFF file (xml)'),
                            ));

        $this->addOptions(array(
                               new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
                               new sfCommandOption('add-new',   null, sfCommandOption::PARAMETER_NONE, 'Add new entries from the csv to the output'),
                               new sfCommandOption('output-culture',   null, sfCommandOption::PARAMETER_REQUIRED, 'Output culture', 'EN'),
                               // add your own options here
                          ));

        $this->namespace = 'xliff';
        $this->name = 'merge-csv';
        $this->briefDescription = 'Merge';
        $this->detailedDescription = <<<EOF
The [xliff:merge-csv|INFO] merges an xliff file with the translations from a csv file
Call it with:

  [php symfony xliff:merge-csv input.xliff.xml input.csv output.xml|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {

        $inputXliffPath = $arguments['input_xliff'];
        $inputCsvPath = $arguments['input_csv'];
        $outputXliffPath = $arguments['output_xliff'];

        $options = array(
          'culture' => $options['output-culture'],
          'add-new' => $options['add-new'],

          'commandTask' => $this,
          );

        $importer = new XliffCsvFileMerger($options);
        $importer->merge($inputXliffPath, $inputCsvPath, $outputXliffPath);
        $this->logSection('importer', 'Done');

        
    }
}
