<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Ext\HasAdminUser;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasAdminUser;

    protected $table = 'page';
    public $timestamps = true;
    protected $fillable = [
        'created_by',
        'updated_by',
        'title',
        'slug',
        'body',
        'is_published',
    ];

    protected $dates = ['created_at', 'updated_at'];
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/pages/'.$this->getKey());
    }

    public static function boot() {
        parent::boot();
        Page::creating(function($entity) {
            $entity->slug = Str::slug(str_replace('.','-',$entity->title), '-', 'de');
        });
        Page::updating(function($entity) {
            $entity->slug = Str::slug(str_replace('.','-',$entity->title), '-', 'de');
        });
    }

    /**
     * @param string $value
     * @return array
     */
    public function getBodyAttribute($value = '')
    {
        if('' !== $value) {
            $wrapper = '<div class="row embed-responsive-wrapper text-center"><div class="embed-responsive embed-responsive-16by9 m-0 p-0">%%</div></div>';
            $sanitized = preg_replace("/(<iframe[^>]+><\/iframe>)/i", str_replace('%%','$1', $wrapper), trim($value));
            return preg_replace(['/^<p>(<br[ ]?[\/]?>){1,}/i','/(<br[ ]?[\/]?>){1,}<\/p>$/i'],['<p>','</p>'], $sanitized);
        }
    }
}
