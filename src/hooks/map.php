<?php
return [
    implode(DIRECTORY_SEPARATOR, [ base_path(), 'resources', 'views', 'components', 'admin', 'box_sidebar.blade.php']) => [
        "{{--  @HOOK_ADMIN_SIDEBAR  --}}" => "\t<x-admin.sidebar.settings_option />\n",
    ],
    implode(DIRECTORY_SEPARATOR, [ base_path(), 'config', 'marinar.php']) => [
        "// @HOOK_MARINAR_CONFIG_ADDONS" => "\t\t\\Marinar\\Settings\\MarinarSettings::class, \n"
    ],
    implode(DIRECTORY_SEPARATOR, [ base_path(), 'app', 'Models', 'Site.php']) => [
        "// @HOOK_TRAITS" => "\tuse \\App\\Traits\\SettingsTrait; \n",
    ],
];
