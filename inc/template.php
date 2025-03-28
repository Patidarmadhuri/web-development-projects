<?php
class Template {
    private $pathToTemplate;
    private $data = [];

    public function __construct($pathToTemplate = null) {
        $this->pathToTemplate = $pathToTemplate;
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function getPathToTemplate() {
        return $this->pathToTemplate;
    }
}
?>