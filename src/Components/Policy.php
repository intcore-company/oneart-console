<?php

namespace MarkRady\OneARTConsole\Components;


/**
 * Class Policy
 *
 * @author Bernat Jufré <info@behind.design>
 *
 * @package OneART\Console\Components
 */
class Policy extends Component
{
    public function __construct($title, $namespace, $file, $path, $relativePath, $content)
    {
        $this->setAttributes([
            'policy' => $title,
            'namespace' => $namespace,
            'file' => $file,
            'path' => $path,
            'relativePath' => $relativePath,
            'content' => $content,
        ]);
    }
}
