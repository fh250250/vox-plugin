<?php namespace Vox\Video\Models;

use October\Rain\Exception\ApplicationException;
use Model;

/**
 * Category Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vox_video_categories';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'vods' => 'Vox\Video\Models\Vod',
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public $timestamps = false;

    public $rules = [
        'title' => 'required|max:64|unique:vox_video_categories'
    ];

    public function beforeDelete()
    {
        if ($this->vods()->count() > 0) {
            throw new ApplicationException('不能删除分类: ' . $this->title);
        }
    }
}
