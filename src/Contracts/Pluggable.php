<?php

namespace Metalc0der\Marketplace\Contracts;

interface Pluggable
{
    public static function application_id(): string;
    public static function application_name(): string;
    public function supports($event): bool;
}