<?php

namespace MarkRady\OneARTConsole\Commands;

/**
 * @author Abed Halawi <abed.halawi@vinelab.com>
 */
class GeneratorCommand extends IlluminateGeneratorCommand
{
    public function __construct(Filesystem $files, Generator $generator)
    {
        parent::__construct($files);

        $this->generator = $generator;
    }
}
