<?php

namespace MarkRady\OneARTConsole\Generators;

use Exception;
use MarkRady\OneARTConsole\Str;
use MarkRady\OneARTConsole\Components\Job;
use Illuminate\Support\Str as StrHelper;
use MarkRady\OneARTConsole\Components\Mail;

class MailGenerator extends Generator
{
    public function generate($mail, $domain)
    {
        $mail = Str::email($mail);
        $domain = Str::domain($domain);
        $path = $this->findMailPath($domain, $mail);
        if ($this->exists($path)) {
            throw new Exception('Mail already exists');

            return false;
        }

        // Create the mail
        $namespace = $this->findDomainMailNamespace($domain);
        $content = file_get_contents($this->getStub());
        $content = str_replace(
            ['{{mail}}', '{{namespace}}'],
            [$mail, $namespace],
            $content
        );

        $this->createFile($path, $content);


        return new Mail(
            $mail,
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
        $stubName = '/stubs/mail.stub';
        return __DIR__.$stubName;
    }

}
