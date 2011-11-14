<?php

class XliffResourceFileImporter extends BaseResourceFileImporter {

  protected $path, $project, $options;
  public function __construct($path, Project $project, $options) {
    $this->path = $path;
    $this->project = $project;
    $this->options = $options;
  }

}
