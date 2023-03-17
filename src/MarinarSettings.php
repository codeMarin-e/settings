<?php
    namespace Marinar\Settings;

    use Marinar\Settings\Database\Seeders\MarinarSettingsInstallSeeder;

    class MarinarSettings {

        public static function getPackageMainDir() {
            return __DIR__;
        }

        public static function injects() {
            return MarinarSettingsInstallSeeder::class;
        }
    }
