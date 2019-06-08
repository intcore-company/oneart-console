<?php


namespace MarkRady\OneARTConsole\Generators;

use Exception;
use MarkRady\OneARTConsole\Str;
use MarkRady\OneARTConsole\Components\Request;


/**
 * Class RequestGenerator
 *
 * @author Bernat Jufré <info@behind.design>
 *
 * @package MarkRady\OneARTConsole\Generators
 */
class RequestGenerator extends Generator
{
    /**
     * Generate the file.
     *
     * @param string $name
     * @param string $domain
     * @return Request|bool
     * @throws Exception
     */
    public function generate($name, $domain)
    {
        $request = Str::request($name);
        $domain = Str::service($domain);
        $path = $this->findRequestPath($domain, $request);

        if ($this->exists($path)) {
            throw new Exception('Request already exists');

            return false;
        }

        $namespace = $this->findRequestsNamespace($domain);

        $content = file_get_contents($this->getStub());
        $content = str_replace(
            ['{{request}}', '{{namespace}}', '{{foundation_namespace}}'],
            [$request, $namespace, $this->findFoundationNamespace()],
            $content
        );

        $this->createFile($path, $content);

        return new Request(
            $request,
            $namespace,
            basename($path),
            $path,
            $this->relativeFromReal($path),
            $this->findDomain($domain),
            $content
        );
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    public function getStub()
    {
        return __DIR__ . '/../Generators/stubs/request.stub';
    }
}
