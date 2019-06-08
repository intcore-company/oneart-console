<?php

namespace MarkRady\OneARTConsole\Components;


/**
 * Class Policy
 *
 * @author Bernat Jufré <info@behind.design>
 *
 * @package MarkRady\OneARTConsole\Components
 */
class Policy extends Component
{
    public function __construct($title, $namespace, $file, $path, $relativePath, Service $service, $content)
    {
        $this->setAttributes([
            'policy' => $title,
            'namespace' => $namespace,
            'file' => $file,
            'path' => $path,
            'service' => $service,
            'relativePath' => $relativePath,
            'content' => $content,
        ]);
    }
}
