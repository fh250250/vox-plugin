<?php namespace Vox\Video\Models;

use Model;

/**
 * Demand Model
 */
class Demand extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vox_video_demands';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'title', 'from'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public $rules = [
        'title' => 'required|max:128|unique:vox_video_demands',
        'from' => 'required|max:32',
    ];

    public static function addDemand($title, $from)
    {
        $demand = self::where('title', '=', $title)->first();

        if ($demand) {
            $demand->increment('count');
        } else {
            self::create([
                'title' => $title,
                'from' => $from
            ]);
        }
    }

    public static function getFilterFromOptions()
    {
        return self::select('from')
                    ->groupBy('from')
                    ->get()
                    ->reduce(function ($opts, $model) {
                        $opts[$model['from']] = $model['from'];
                        return $opts;
                    }, []);
    }
}
