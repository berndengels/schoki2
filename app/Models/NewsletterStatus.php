<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NewsletterStatus
 *
 * @property int $id
 * @property string $name
 * @property-read mixed $resource_url
 * @method static Builder|NewsletterStatus newModelQuery()
 * @method static Builder|NewsletterStatus newQuery()
 * @method static Builder|NewsletterStatus query()
 * @method static Builder|NewsletterStatus whereId($value)
 * @method static Builder|NewsletterStatus whereName($value)
 * @mixin Eloquent
 */
class NewsletterStatus extends Model
{
    protected $table = 'newsletter_status';

    protected $fillable = [
        'name',

    ];


    protected $dates = [

    ];
    public $timestamps = false;

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/newsletter-statuses/'.$this->getKey());
    }
}
