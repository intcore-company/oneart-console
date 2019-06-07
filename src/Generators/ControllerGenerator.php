<?php

namespace MarkRady\OneARTConsole\Generators;

use Exception;
use MarkRady\OneARTConsole\Str;

class ControllerGenerator extends Generator
{
    /**
     * Generate the file.
     *
     * @param $name
     * @param $domain
     * @return Controller|bool
     * @throws Exception
     */
    public function generate($name, $domain, $plain = false)
    {
        $name = Str::controller($name);
        $domain = Str::service($domain);

        $path = $this->findControllerPath($domain, $name);

        if ($this->exists($path)) {
            throw new Exception('Controller already exists!');

            return false;
        }

        $namespace = $this->findControllerNamespace($domain);

        $content = file_get_contents($this->getStub($plain));
        $content = str_replace(
             ['{{controller}}', '{{namespace}}', '{{foundation_namespace}}'],
             [$name, $namespace, $this->findFoundationNamespace()],
             $content
         );

        $this->createFile($path, $content);

        return $this->relativeFromReal($path);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub($plain)
    {
        if ($plain) {
            return __DIR__.'/stubs/controller.plain.stub';
        }

        return __DIR__.'/stubs/controller.stub';
    }
}
