<?php

namespace Modules\Gallery\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'gallery';

    /**
     * Caegories has Many posts.
     */
    public function posts()
    {
        return $this->hasMany('Modules\Post\Models\Post');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Gallery\database\factories\GalleryFactory::new();
    }
}
