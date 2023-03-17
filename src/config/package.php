<?php
	return [
		'install' => [
            'php artisan db:seed --class="\Marinar\Settings\Database\Seeders\MarinarSettingsInstallSeeder"',
		],
		'remove' => [
            'php artisan db:seed --class="\Marinar\Settings\Database\Seeders\MarinarSettingsRemoveSeeder"',
        ]
	];
