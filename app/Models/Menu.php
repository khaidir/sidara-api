<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'label',
        'icon',
        'description',
        'link',
        'menu_id'
    ];

    // Relasi ke child menus
    public function children()
    {
        // return $this->hasMany(Menu::class, 'menu_id');
        return $this->hasMany(Menu::class, 'menu_id')
            ->select(['id', 'name', 'label', 'icon', 'description', 'link', 'menu_id']);
    }

    // Relasi ke parent menu
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
