<?php namespace Vox\Video;

use Backend;
use System\Classes\PluginBase;

/**
 * Video Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Video',
            'description' => 'Manage video resources',
            'author'      => 'Vox',
            'icon'        => 'icon-video-camera'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Vox\Video\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'vox.video.vods' => [
                'tab' => '影视',
                'label' => '管理视频'
            ],
            'vox.video.categories' => [
                'tab' => '影视',
                'label' => '管理分类'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'video' => [
                'label'       => '影视',
                'url'         => Backend::url('vox/video/vods'),
                'icon'        => 'icon-video-camera',
                'permissions' => ['vox.video.*'],
                'order'       => 500,

                'sideMenu' => [
                    'categories' => [
                        'label' => '分类',
                        'url' => Backend::url('vox/video/categories'),
                        'icon' => 'icon-th-large',
                        'permissions' => ['vox.video.categories']
                    ],
                    'vods' => [
                        'label' => '视频',
                        'url' => Backend::url('vox/video/vods'),
                        'icon' => 'icon-cubes',
                        'permissions' => ['vox.video.vods']
                    ],
                ]
            ],
        ];
    }
}
