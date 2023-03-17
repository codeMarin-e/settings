<?php
    namespace App\Traits;

    use \App\Traits\AddVariable;
    use \App\Traits\Addressable;
    use \App\Traits\Attachable;

    trait SettingsTrait {
        use AddVariable;
        use Addressable;

        public static $attach_folder = 'settings';
        use Attachable;

    }
