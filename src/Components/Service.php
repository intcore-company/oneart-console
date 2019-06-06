<?php

namespace MarkRady\OneARTConsole\Components;

/**
 * @author Abed Halawi <abed.halawi@vinelab.com>
 */
class Service extends Component
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

    // public function toArray()
    // {
    //     $attributes = parent::toArray();
    //
    //     unset($attributes['realPath']);
    //
    //     return $attributes;
    // }
}
