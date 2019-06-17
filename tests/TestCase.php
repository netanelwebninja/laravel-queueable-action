<?php

namespace Spatie\QueueableAction\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Spatie\QueueableAction\QueueableActionServiceProvider;

class TestCase extends OrchestraTestCase
{
    const LOG_PATH = __DIR__.'/temp/queue.log';

    protected function setUp(): void
    {
        parent::setUp();

        $this->clearLog();
    }

    protected function getPackageProviders($app)
    {
        return [
            QueueableActionServiceProvider::class,
        ];
    }

    protected function clearLog()
    {
        if (! file_exists(self::LOG_PATH)) {
            return;
        }

        unlink(self::LOG_PATH);
    }

    protected function assertLogHas(string $text)
    {
        $log = file_get_contents(self::LOG_PATH);

        $this->assertStringContainsString($text, $log);
    }
}
