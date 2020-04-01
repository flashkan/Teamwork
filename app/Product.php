<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static function rules()
    {
        $tableNameUser = (new User())->getTable();
        return [
            'name' => 'required|min:5|max:30',
            'description' => 'min:10|max:255',
            'owner_id' => "required|exists:{$tableNameUser},id",
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class)->first();
    }

    public function ownerLots() {
        return $this->hasMany(Lot::class)->get();
    }
}
