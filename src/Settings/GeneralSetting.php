<?php
namespace SantosSabanari\LaravelFoundation\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $countdown;

    public static function group(): string
    {
        return 'general';
    }
}
