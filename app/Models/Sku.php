<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Translatable;

class Sku extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    protected $fillable = [
        'product_id',
        'count',
        'price'
    ];
    protected $visible = [
        'id',
        'count',
        'price',
        'product_name',
        'options'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function propertyOptions(){
        return $this->belongsToMany(PropertyOption::class, 'sku_property_option')->withTimestamps();
    }

    public function isAvailable(){
        return !$this->product->trashed() && $this->count > 0;
    }
}
