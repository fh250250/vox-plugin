<?php namespace Vox\Video\Models;

use Model;

class Settings extends Model
{
  public $implement = ['System.Behaviors.SettingsModel'];
  public $settingsCode = 'vox_video_settings';
  public $settingsFields = 'fields.yaml';
}
