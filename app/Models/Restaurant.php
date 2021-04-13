<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Restaurant extends Model
{
    use HasFactory;
    public function restaurantMenus()
    {
    return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
