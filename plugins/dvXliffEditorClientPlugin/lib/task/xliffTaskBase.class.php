<?php

abstract class xliffTaskBase extends sfBaseTask
{
    protected function getAvailableCatalogs() {
        $files = sfFinder::type('file')->name('*.xml')->in(sfConfig::get('sf_apps_dir'));
        $result = array();
        foreach($files as $file) {
            $resourceName = basename($file, '.xml');
            $language = basename(dirname($file));
            $result[] = array(
                'path' => $file,
                'resource_name' => $resourceName,
                'language' => $language
            );
        }

        return $result;
    }
}
