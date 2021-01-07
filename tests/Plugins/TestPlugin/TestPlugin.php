<?php

namespace Metalc0der\Marketplace\Tests\Plugins\TestPlugin;

use Metalc0der\Marketplace\Contracts\Pluggable;

class TestPlugin implements Pluggable
{
    public static function application_id(): string
    {
        return 'test_plugin';
    }

    public static function application_name(): string
    {
        return 'Test Plugin';
    }

    public function supports($event): bool
    {
        return false;
    }
}