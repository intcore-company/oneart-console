<?php

namespace MarkRady\OneARTConsole\Generators;

use Exception;
use MarkRady\OneARTConsole\Str;
use MarkRady\OneARTConsole\Components\Job;
use Illuminate\Support\Str as StrHelper;

class ResourceGenerator extends Generator
{
    public function generate($resource, $domain, $isCollection = false)
    {
        $domain = Str::domain($domain);
        $path = $this->findResourcePath($domain, $resource);

        if ($this->exists($path)) {
            throw new Exception('Resource already exists');

            return false;
        }

        // Make sure the domain directory exists
        $this->createDomainDirectory($domain);

        // Create the Resource
        $namespace = $this->findDomainResourceNamespace($domain);
        $content = file_get_contents($this->getStub($isCollection));
        $content = str_replace(
            ['{{resource}}', '{{namespace}}', '{{foundation_namespace}}'],
            [$resource, $namespace, $this->findFoundationNamespace()],
            $content
        );

        $this->createFile($path, $content);

        return new Job(
            $resource,
            $namespace,
            basename($path),
            $path,
            $this->relativeFromReal($path),
            ($domain) ? $this->findDomain($domain) : null,
            $content
        );
    }


    /**
     * Create domain directory.
     *
     * @param string $domain
     */
    private function createDomainDirectory($domain)
    {
        $this->createDirectory($this->findDomainPath($domain).'/Http/Resources');
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    public function getStub($isCollection = false)
    {
        $stubName;
        if ($isCollection) {
            $stubName = '/stubs/resource-collection.stub';
        } else {
            $stubName = '/stubs/resource.stub';
        }
        return __DIR__.$stubName;
    }

}
