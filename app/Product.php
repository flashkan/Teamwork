<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class Product extends Model
{
    public static function rules()
    {
        $tableNameUser = (new User())->getTable();
        return [
            'name' => 'required|min:5|max:30',
            'description' => 'min:10|max:255',
            'owner_id' => "required|exists:{$tableNameUser},id",
            'img' => 'image|dimensions:min_width=100,min_height=200'
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'owner_id', 'img_url',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class)->first();
    }

    public function ownerLots()
    {
        return $this->hasMany(Lot::class)->get();
    }

    public function transferOwnership($currentBuyerId)
    {
        $this->bought_by = $currentBuyerId;
        $this->save();
    }

    public function deleteImage(Request $request)
    {
        Storage::disk('public')->delete($this->img_url);
        $request->merge(['img_url' => null]);
    }

    public function addImage(Request $request)
    {
        $pathToImg = $request->file('img')->store('uploads', 'public');
        $request->merge(['img_url' => $pathToImg]);
    }

    public function addImageWithLink(String $link)
    {
        $contents = file_get_contents($link);
        $path = Storage::putFile('uploads', new File($link));
        $this->img_url = $path;
        $this->update();
    }
}
