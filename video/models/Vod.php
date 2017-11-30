<?php namespace Vox\Video\Models;

use Model;
use Db;

/**
 * Vod Model
 */
class Vod extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vox_video_vods';

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
    public $hasMany = [];
    public $belongsTo = [
        'category' => 'Vox\Video\Models\Category',
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'poster' => 'System\Models\File'
    ];
    public $attachMany = [];

    public $rules = [
        'title' => 'required|max:128|unique:vox_video_vods',
        'poster' => 'required|image|max:2048',
        'category' => 'required',
        'downloads' => 'required',
    ];

    protected $jsonable = ['downloads'];

    public function incrementViewCount()
    {
        Db::table($this->table)
            ->where('id', '=', $this->id)
            ->increment('view_count');
    }

    public static function findByCategoryID($category_id)
    {
        return self::where('category_id', '=', $category_id)
                    ->with('poster')
                    ->orderBy('view_count', 'desc')
                    ->simplePaginate(20);
    }
}
