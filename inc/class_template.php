<?php
class Template
{
    private $templatePath;
    private $variables = [];

    public function __construct($pathToTemplate)
    {
        $this->templatePath = $pathToTemplate;
    }

    public function set($variableName, $value)
    {
        $this->variables[$variableName] = $value;
    }

    public function get($variableName)
    {
        if (isset($this->variables[$variableName]))
        {
            return $this->variables[$variableName];
        }
        return "";
    }

    public function display()
    {
        extract($this->variables);
        include $this->templatePath;
    }
}
?>