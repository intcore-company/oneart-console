<?php

namespace MarkRady\OneARTConsole\Components;

use Illuminate\Support\Str;

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
