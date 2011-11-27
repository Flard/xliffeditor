<?php
/**
 * Created by JetBrains PhpStorm.
 * User: grad
 * Date: 11/27/11
 * Time: 2:55 PM
 * To change this template use File | Settings | File Templates.
 */

class XliffResourceFileExporter extends BaseResourceFileExporter
{
    protected $resource, $options;

    public function __construct(Resource $resource, $options = array())
    {
        $this->resource = $resource;
        $this->options = $options;
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

        if (null !== $xml && is_string($xml)) {
            // Add header for XML with UTF-8
            if (!preg_match('/<\?xml/', $xml)) {
                $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . $xml;
            }

            $dom->loadXML($xml);
        }

        return $dom;
    }

    protected function loadMessageArray($language) {
        $messages = array();

        foreach($this->resource->getLines() as $line) {
            $sourceText = $line->source_text;
            $targetText = $line->getTargetText($language, '');

            $messages[$sourceText] = $targetText;
        }

        return $messages;
    }

    protected function getXmlDocument(ProjectLanguage $language)
    {
        $catalogue = $this->resource->filename;

        $dom = $this->createDOMDocument($this->getTemplate($language->lang, $catalogue));
        // find the body element
        $xpath = new DomXPath($dom);
        $body = $xpath->query('//body')->item(0);

        $count = 0;

        $messages = $this->loadMessageArray($language);

        foreach ($messages as $sourceText => $targetText)
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

        return $dom;
    }

    public function exportToResponse(ProjectLanguage $language, sfWebResponse $response)
    {
        $xml = $this->getXmlDocument($language);
        $response->setContentType('text/xml');
        $response->setHttpHeader('Content-Disposition', 'attachment;filename='.$this->resource->getFilename());
        $xmlText = $xml->saveXML();
        $response->setContent($xmlText);
        return sfView::NONE;
    }

    public function exportToFile(ProjectLanguage $language, $path)
    {
        $xml = $this->getXmlDocument($language);
        $xml->save($path);
    }

      protected function getTemplate($languageCode, $catalogue)
  {
    $date = date('c');

    return <<<EOD
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xliff PUBLIC "-//XLIFF//DTD XLIFF//EN" "http://www.oasis-open.org/committees/xliff/documents/xliff.dtd" >
<xliff version="1.0">
  <file source-language="EN" target-language="$languageCode" datatype="plaintext" original="$catalogue" date="$date" product-name="$catalogue">
    <header />
    <body>
    </body>
  </file>
</xliff>
EOD;
  }
}
