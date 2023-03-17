<?php
    namespace Marinar\Settings\Database\Seeders;

    use Illuminate\Database\Seeder;
    use Marinar\Settings\MarinarSettings;

    class MarinarSettingsInstallSeeder extends Seeder {

        use \Marinar\Marinar\Traits\MarinarSeedersTrait;

        public static function configure() {
            static::$packageName = 'marinar_settings';
            static::$packageDir = MarinarSettings::getPackageMainDir();
        }

        public function run() {
            if(!in_array(env('APP_ENV'), ['dev', 'local'])) return;

            $this->autoInstall();

            $this->refComponents->info("Done!");
        }

    }
