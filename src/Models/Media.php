<?php

namespace Rafadepaula\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property int $gallery_id
 * @property string $title
 * @property string $content
 * @property string $type
 * @property Gallery $gallery
 */
class Media extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'medias';

    /**
     * @var array
     */
    protected $fillable = ['gallery_id', 'title', 'content', 'type'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }

    public function getContentUrlAttribute(){
		return Storage::url($this->content);
	}
}
