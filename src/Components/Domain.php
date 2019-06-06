<?php

namespace MarkRady\OneARTConsole\Components;

use Illuminate\Support\Str;

/**
 * @author Abed Halawi <abed.halawi@vinelab.com>
 */
class Domain extends Component
{
    public function __construct($name, $namespace, $path, $relativePath)
    {
        $this->setAttributes([
            'name' => $name,
            'slug' => Str::studly($name),
            'namespace' => $namespace,
            'realPath' => $path,
            'relativePath' => $relativePath,
        ]);
    }
}
