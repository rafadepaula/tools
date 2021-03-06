<?php


namespace Rafadepaula\Tools\Facades;


use App\Models\Gallery;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

trait MediasUploader
{
	public $useMedia = true;

	public function saveMedias($request, $model, $alt = '')
	{
		if (!empty($request->medias) || !empty($request->mediaFiles)) {
			$gallery = Gallery::getOrCreate($model);

			$imagesUpload = $this->uploadImages($request, 'medias', true, $alt);
			$filesUpload = $this->uploadFiles($request);
			$files = array_merge($imagesUpload, $filesUpload);

			if(!empty($files)) {
				if (!$gallery->medias()->saveMany($files))
					return false;
				if(!$model->gallery()->associate($gallery)->save())
					return false;
			}
		}

		return true;
	}

	public function uploadImages($request, $path = 'medias', $originalName = true, $alt = '')
	{
		$files = [];
		if(!empty($request->medias)) {
			if(!is_array($request->medias))
				$request->medias = [$request->medias];
			foreach ($request->medias as $media) {
				if ($media->isValid()) {
					if($originalName){
						$filename = $media->getClientOriginalName();
						if(Storage::disk('public')->exists($path.'/'.$filename))
							Storage::disk('public')->delete($path.'/'.$filename);
						$upload = $media->storeAs($path, $filename);
					}else{
						$upload = $media->store($path);
					}
					$files[] = new Media(['content' => $upload, 'type' => 'I', 'alt' => $alt, 'title' => $alt]);
				}
			}
		}
		return $files;
	}

	private function uploadFiles($request)
	{
		$files = [];
		if(!empty($request->mediaFiles)){
			foreach ($request->mediaFiles as $file) {
				if(!empty($file['file'])) {
					$media = $file['file'];
					$title = $file['title'] ?? null;
					if ($media->isValid()) {
						$upload = $media->store('medias');
						$files[] = new Media([
							'content' => $upload,
							'type' => 'F',
							'title' => $title
						]);
					}
				}
			}
		}
		return $files;
	}

	public function deleteMedia($media_id)
	{
		$media = Media::find($media_id);
		Storage::delete($media->content);
		$media->delete();
	}
}