<?php

namespace MarkRady\OneARTConsole\Components;


/**
 * Class Model
 *
 * @author Bernat Jufré <info@behind.design>
 *
 * @package MarkRady\OneARTConsole\Components
 */
class Model extends Component
{
    public function __construct($title, $namespace, $file, $path, $relativePath, Domain $domain, $content)
    {
        $this->setAttributes([
            'model' => $title,
            'namespace' => $namespace,
            'file' => $file,
            'path' => $path,
            'relativePath' => $relativePath,
            'content' => $content,
        ]);
    }
}
