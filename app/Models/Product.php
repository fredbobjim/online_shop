<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Translatable;

class Product extends Model
{
    use SoftDeletes;
    use Translatable;

    protected $fillable = [
        'code',
        'name',
        'category_id',
        'description',
        'image',
        'price',
        'hit',
        'new',
        'recommended',
        'count',
    ];

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_product')->withTimestamps();
    }

    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }




    public function scopeHit($query)
    {
        return $query->where('hit', 1);
    }

    public function scopeNew($query)
    {
        return $query->where('new', 1);
    }

    public function scopeRecommended($query)
    {
        return $query->where('recommended', 1);
    }

    public function setNewAttribute($value)
    {
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }

    public function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }

    public function setRecommendedAttribute($value)
    {
        $this->attributes['recommended'] = $value === 'on' ? 1 : 0;
    }

    public function isHit()
    {
        return $this->hit === 1;
    }
    public function isNew()
    {
        return $this->new === 1;
    }
    public function isRecommended()
    {
        return $this->recommended === 1;
    }

    public function getSkusCount(): int
    {
        return $this->skus()->count();
    }
}
