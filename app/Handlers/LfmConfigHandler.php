<?php

    namespace App\Handlers;

    use UniSharp\LaravelFilemanager\Handlers\ConfigHandler;

    class LfmConfigHandler extends ConfigHandler
    {
        public function userField()
        {
            return parent::userField();
        }
    }
