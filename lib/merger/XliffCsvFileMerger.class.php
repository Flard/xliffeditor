<?php

class XliffCsvFileMerger {

    protected $translations = array();
    protected $inputXmlPath;
    protected $culture;
    protected $addNew = false;

    protected $commandTask;

    public function __construct(array $options = array()) {
        $this->culture = $options['culture'];
        $this->addNew = $options['add-new'];

        $this->commandTask = isset($options['commandTask']) ? $options['commandTask'] : false;
    }

    public function merge($inputXml, $inputCsv, $outputCsv) {
        $this->inputXmlPath = $inputXml;

        $this->loadInputXml($inputXml);
        $this->applyCsv($inputCsv);
        $this->writeOutputXml($outputCsv);

    }

    protected function loadInputXml($path) {
        
        $this->translations = array();

        $xml = $this->loadDom($path);
        $translationUnits = $xml->xpath('//trans-unit');

        foreach($translationUnits as $unit) {
            $source = (string)$unit->source;
            $target = (string)$unit->target;

            $this->translations[$source] = $target;
        }

        $this->info('Loaded '.count($this->translations).' translations from input xliff.');
    }

    protected function applyCsv($path) {

        $lines = 0;
        if (($handle = fopen($path, 'r')) !== FALSE) {  // Try to open file
            
            while (($data = fgetcsv($handle, 0, ';')) !== FALSE) { // read lines
                list($source, $target) = $data;

                if (!array_key_exists($source, $this->translations)) {
                    $this->warn('No base translation found for "'.$source.'"');

                    if (!$this->addNew) {
                        continue;
                    }
                }

                $this->translations[$source] = $target;
                $lines++;
            }

            fclose($handle);

        }
        $this->info('Imported '.$lines.' translations from the input csv');

    }

    protected function writeOutputXml($path) {

        $dom = $this->createDOMDocument();
        $xpath = new DomXPath($dom);
        $body = $xpath->query('//body')->item(0);

        if (null === $body)
        {
          //create and try again
          $this->createMessageTemplate($path);
          $dom->load($path);
          $xpath = new DomXPath($dom);
          $body = $xpath->query('//body')->item(0);
        }

        $count = 0;
        foreach ($this->translations as $sourceText => $targetText)
        {
          $unit = $dom->createElement('trans-unit');
          $unit->setAttribute('id', ++$count);

          $source = $dom->createElement('source');
          $source->appendChild($dom->createTextNode($sourceText));
          $target = $dom->createElement('target');
          $target->appendChild($dom->createTextNode($targetText));

          $unit->appendChild($source);
          $unit->appendChild($target);

          $body->appendChild($unit);
        }

        $fileNode = $xpath->query('//file')->item(0);
        $fileNode->setAttribute('date', @date('Y-m-d\TH:i:s\Z'));

        $dom = $this->createDOMDocument($dom->saveXML());

        // save it and clear the cache for this variant
        $dom->save($path);
        return $path;
    }

    protected function info($message) {
        if ($this->commandTask!== false) {
          $this->commandTask->logSection('csv-merge', $message);
        }
    }

    protected function warn($message) {
        if ($this->commandTask !== false) {
          $this->commandTask->logSection('csv-merge', $message, null, 'COMMENT');
        }
    }

    protected function loadDom($path) {
        libxml_use_internal_errors(true);
        if (!$xml = simplexml_load_file($path)) {
            $error = false;

            return $error;
        }
        libxml_use_internal_errors(false);
        return $xml;
    }

    protected function loadTranslations()
    {
        $xml = $this->dom;
        $translationUnit = $xml->xpath('//trans-unit');

        $translations = array();

        foreach ($translationUnit as $unit)
        {
            $source = (string)$unit->source;
            $translations[$source][] = (string)$unit->target;
            $translations[$source][] = (string)$unit['id'];
            $translations[$source][] = (string)$unit->note;
        }

        return $translations;
    }

  /**
   * Creates and returns a new DOMDocument instance
   *
   * @param  string  $xml  XML string
   *
   * @return DOMDocument
   */
  protected function createDOMDocument($xml = null)
  {
    $domimp = new DOMImplementation();
    $doctype = $domimp->createDocumentType('xliff', '-//XLIFF//DTD XLIFF//EN', 'http://www.oasis-open.org/committees/xliff/documents/xliff.dtd');
    $dom = $domimp->createDocument('', '', $doctype);
    $dom->formatOutput = true;
    $dom->preserveWhiteSpace = false;

    if (null !== $xml && is_string($xml))
    {
      // Add header for XML with UTF-8
      if (!preg_match('/<\?xml/', $xml))
      {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".$xml;
      }
      $dom->encoding = 'UTF-8';
      $dom->loadXML($xml);
    }

    return $dom;
  }

protected function createMessageTemplate($file)
  {
      $catalogue = 'messages';

    $dir = dirname($file);
    if (!is_dir($dir))
    {
      @mkdir($dir);
      @chmod($dir, 0777);
    }

    if (!is_dir($dir))
    {
      throw new sfException(sprintf("Unable to create directory %s.", $dir));
    }

    $dom = $this->createDOMDocument($this->getTemplate($catalogue));
    file_put_contents($file, $dom->saveXML());
    chmod($file, 0777);

    return array($file);
  }

  protected function getTemplate($catalogue)
  {
    $date = date('c');

    return <<<EOD
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xliff PUBLIC "-//XLIFF//DTD XLIFF//EN" "http://www.oasis-open.org/committees/xliff/documents/xliff.dtd" >
<xliff version="1.0">
  <file source-language="EN" target-language="{$this->culture}" datatype="plaintext" original="$catalogue" date="$date" product-name="$catalogue">
    <header />
    <body>
    </body>
  </file>
</xliff>
EOD;
  }
}