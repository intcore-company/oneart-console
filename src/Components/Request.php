<?php


namespace MarkRady\OneARTConsole\Components;


/**
 * Class Request
 *
 * @author Bernat Jufré <info@behind.design>
 *
 * @package MarkRady\OneARTConsole\Components
 */
class Request extends Component
{
    public function __construct($title, $namespace, $file, $path, $relativePath, Domain $domain, $content)
    {
        $this->setAttributes([
            'request' => $title,
            'domain' => $domain,
            'namespace' => $namespace,
            'file' => $file,
            'path' => $path,
            'relativePath' => $relativePath,
            'content' => $content,
        ]);
    }
}
