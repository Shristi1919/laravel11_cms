<?php

namespace Modules\Page\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pages';

    /**
     * Get all of the posts that are assigned this page.
     */
    public function posts()
    {
        return $this->morphedByMany('Modules\Post\Models\Post', 'Pagegable');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Page\database\factories\PageFactory::new();
    }
}
