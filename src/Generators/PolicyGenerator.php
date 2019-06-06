<?php


namespace MarkRady\OneARTConsole\Generators;

use Exception;
use OneART\Console\Str;
use OneART\Console\Components\Policy;


/**
 * Class PolicyGenerator
 *
 * @author Bernat Jufré <info@behind.design>
 *
 * @package OneART\Console\Generators
 */
class PolicyGenerator extends Generator
{
    /**
     * Generate the file.
     *
     * @param $name
     * @return Policy|bool
     * @throws Exception
     */
    public function generate($name)
    {
        $policy = Str::policy($name);
        $path = $this->findPolicyPath($policy);

        if ($this->exists($path)) {
            throw new Exception('Policy already exists');

            return false;
        }

        $this->createPolicyDirectory();

        $namespace = $this->findPolicyNamespace();

        $content = file_get_contents($this->getStub());
        $content = str_replace(
            ['{{policy}}', '{{namespace}}', '{{foundation_namespace}}'],
            [$policy, $namespace, $this->findFoundationNamespace()],
            $content
        );

        $this->createFile($path, $content);

        return new Policy(
            $policy,
            $namespace,
            basename($path),
            $path,
            $this->relativeFromReal($path),
            $content
        );
    }

    /**
     * Create Policies directory.
     */
    public function createPolicyDirectory()
    {
        $this->createDirectory($this->findPoliciesPath());
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    public function getStub()
    {
        return __DIR__ . '/../Generators/stubs/policy.stub';
    }
}
