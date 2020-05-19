<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;


class Admin extends Authenticatable
{
  use Notifiable, HasRoles;

  protected $guard = 'admin';
  protected $guard_name = 'admin';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name','staff_id', 'username', 'password', 'description',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * Get user permissions and roles.
   *
   * @return json
   */
  public function jsPermissions()
  {
    return json_encode([
      'roles' => $this->getRoleNames(),
      'permissions' => $this->getAllPermissions()->pluck('name'),
    ]);
  }

  /**
   * Get the staff record associated with the admin
   */
  public function staff()
  {
    return $this->belongsTo('App\models\Staff');
  }
}
