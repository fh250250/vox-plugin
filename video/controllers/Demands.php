<?php namespace Vox\Video\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Demands Back-end Controller
 */
class Demands extends Controller
{
    public $implement = [
        // 'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    // public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Vox.Video', 'video', 'demands');
    }
}
