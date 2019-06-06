<?php

namespace MarkRady\OneARTConsole\Components;

/**
 * @author Ali Issa <ali@vinelab.com>
 */
class Operation extends Component
{
    public function __construct($title, $file, $realPath, $relativePath, Service $service = null, $content = '')
    {
        $className = str_replace(' ', '', $title).'Operation';

        $this->setAttributes([
            'title' => $title,
            'className' => $className,
            'service' => $service,
            'file' => $file,
            'realPath' => $realPath,
            'relativePath' => $relativePath,
            'content' => $content,
        ]);
    }
}
