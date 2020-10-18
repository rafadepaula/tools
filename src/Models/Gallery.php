<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property Media[] $medias
 */
class Gallery extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'description'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medias()
    {
        return $this->hasMany('App\Media');
    }

    public static function getOrCreate($model){

		$title = 'Galeria de Arquivos';
		if(!empty($model->title))
			$title .= ' - '.$model->title;
		$title .= ' ('.$model->id.')';
		if ($model->gallery)
			$gallery = $model->gallery;
		else
			$gallery = Gallery::create(['title' => $title]);

		return $gallery;
	}
}
