<?php

namespace MarkRady\OneARTConsole\Components;

use Illuminate\Support\Str;

class Domain extends Component
{
    public function __construct($name, $realPath, $relativePath)
    {
        $this->setAttributes([
            'name' => $name,
            'slug' => snake_case($name),
            'realPath' => $realPath,
            'relativePath' => $relativePath,
        ]);
    }
}
