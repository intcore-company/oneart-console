<?php

namespace MarkRady\OneARTConsole\Generators;

use Exception;
use MarkRady\OneARTConsole\Str;
use MarkRady\OneARTConsole\Components\Job;

class JobGenerator extends Generator
{
    public function generate($job, $domain, $isQueueable = false)
    {
        $job = Str::job($job);
        $domain = Str::domain($domain);
        $path = $this->findJobPath($domain, $job);

        if ($this->exists($path)) {
            throw new Exception('Job already exists');

            return false;
        }

        // Make sure the domain directory exists
        // $this->createDomainDirectory($domain);

        // Create the job
        $namespace = $this->findDomainJobsNamespace($domain);
        $content = file_get_contents($this->getStub($isQueueable));
        $content = str_replace(
            ['{{job}}', '{{namespace}}', '{{foundation_namespace}}'],
            [$job, $namespace, $this->findFoundationNamespace()],
            $content
        );

        $this->createFile($path, $content);

        $this->generateTestFile($job, $domain);

        return new Job(
            $job,
            $namespace,
            basename($path),
            $path,
            $this->relativeFromReal($path),
            ($domain) ? $this->findDomain($domain) : null,
            $content
        );
    }

    /**
     * Generate test file.
     *
     * @param string $job
     * @param string $domain
     */
    private function generateTestFile($job, $domain)
    {
        $content = file_get_contents($this->getTestStub());

        $namespace = $this->findDomainJobsTestsNamespace($domain);
        $jobNamespace = $this->findDomainJobsNamespace($domain)."\\$job";
        $testClass = $job.'Test';

        $content = str_replace(
            ['{{namespace}}', '{{testclass}}', '{{job}}', '{{job_namespace}}'],
            [$namespace, $testClass, snake_case($job), $jobNamespace],
            $content
        );

        $path = $this->findJobTestPath($domain, $testClass);

        $this->createFile($path, $content);
    }

    /**
     * Create domain directory.
     *
     * @param string $domain
     */
    private function createDomainDirectory($domain)
    {
        $this->createDirectory($this->findDomainPath($domain).'/Jobs');
        $this->createDirectory($this->findDomainTestsPath($domain).'/Jobs');
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    public function getStub($isQueueable = false)
    {
        $stubName;
        if ($isQueueable) {
            $stubName = '/stubs/queueable-job.stub';
        } else {
            $stubName = '/stubs/job.stub';
        }
        return __DIR__.$stubName;
    }

    /**
     * Get the test stub file for the generator.
     *
     * @return string
     */
    public function getTestStub()
    {
        return __DIR__.'/stubs/job-test.stub';
    }
}
