<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    public static function rules()
    {
        if (preg_match('/update/', request()->getRequestUri())) {
            $rulesForUpdate = [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
            ];

            if (request()->email !== request()->old_email) {
                $rulesForUpdate['email'] .= '|unique:users';
            }

            if (request()->update_password) {
                $rulesForUpdate['password'] = 'required|string|min:8|confirmed';
            }

            return $rulesForUpdate;
        }
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public static function rulesForUpdatePass()
    {
        return [
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'owner_id')
            ->where('bought_by', null)
            ->where('is_delete', 0)
            ->get();
    }

    public function unsoldProducts()
    {
        return $this->products()->whereNull('bought_by');
    }

    public function seller()
    {
        return $this->hasMany(Lot::class, 'seller_id')->get();
    }

    public function buyer()
    {
        return $this->hasMany(Lot::class, 'current_buyer_id')->get();
    }

    public function balance()
    {
        return $this->hasOne(Balance::class)->first();
    }

    public static function isAdmin()
    {
        if (Auth::user()->is_admin) return true;
    }

    public static function checkPass($password)
    {
        return Hash::check($password, Auth::user()->getAuthPassword());
    }
}
