<?php
    namespace Marinar\Settings\Database\Seeders;

    use App\Models\PaymentMethod;
    use Illuminate\Database\Seeder;
    use Marinar\Settings\MarinarSettings;
    use Spatie\Permission\Models\Permission;

    class MarinarSettingsRemoveSeeder extends Seeder {

        use \Marinar\Marinar\Traits\MarinarSeedersTrait;

        public static function configure() {
            static::$packageName = 'marinar_settings';
            static::$packageDir = MarinarSettings::getPackageMainDir();
        }

        public function run() {
            if(!in_array(env('APP_ENV'), ['dev', 'local'])) return;

            $this->autoRemove();

            $this->refComponents->info("Done!");
        }

        public function clearMe() {
            $this->refComponents->task("Clear DB", function() {
                Permission::whereIn('name', [
                    'settings.view',
                    'settings.update',
                ])
                ->where('guard_name', 'admin')
                ->delete();
                app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
                return true;
            });
        }
    }
