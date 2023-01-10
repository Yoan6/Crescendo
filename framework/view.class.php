<?php


class View {
  private array $param;
  private string $filePath;

  function __construct() {
    $this->param = array();
    $this->filePath =  "../view/";
  }

  function assign(string $varName,$value) {
    $this->param[$varName] = $value;
  }

  function display(string $filename) {

    $this->filePath .= $filename;

    foreach ($this->param as $key => $value) {
      $$key = $value;
    }
    require($this->filePath);
    exit(0);
  }
}
?>
