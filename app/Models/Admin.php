<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;


class Admin extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'admin_email', 'admin_password', 'admin_name', 'admin_phone'
    ];
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';

    public function roles(){
        return $this->belongsToMany(Roles::class);
    }

    public function hasAnyRoles($roles){
        return null != $this->roles()->whereIn('name', $roles)->first();
    }
    
    public function hasRoles($role){
        return null != $this->roles()->where('name', $role)->first();
    }

    public function getAuthPassword(){
        return $this->admin_password;
    }
}
