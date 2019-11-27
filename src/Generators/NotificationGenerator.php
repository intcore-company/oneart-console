<?php

namespace MarkRady\OneARTConsole\Generators;

use Exception;
use MarkRady\OneARTConsole\Str;
use MarkRady\OneARTConsole\Components\Job;
use Illuminate\Support\Str as StrHelper;
use MarkRady\OneARTConsole\Components\Notification;

class NotificationGenerator extends Generator
{
    public function generate($notification, $domain)
    {
        $notification = Str::notification($notification);
        $domain = Str::domain($domain);
        $path = $this->findNotificationPath($domain, $notification);
        if ($this->exists($path)) {
            throw new Exception('Notification already exists');

            return false;
        }

        // Create the Notification
        $namespace = $this->findDomainNotificationNamespace($domain);
        $content = file_get_contents($this->getStub());
        $content = str_replace(
            ['{{notification}}', '{{namespace}}'],
            [$notification, $namespace],
            $content
        );

        $this->createFile($path, $content);


        return new Notification(
            $notification,
            $namespace,
            basename($path),
            $path,
            $this->relativeFromReal($path),
            ($domain) ? $this->findDomain($domain) : null,
            $content
        );
    }



    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    public function getStub($isQueueable = false)
    {
        $stubName = '/stubs/notification.stub';
        return __DIR__.$stubName;
    }


}
