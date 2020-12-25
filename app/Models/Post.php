<?php

namespace App\Models;

use App\Mail\storedPost;
use App\Mail\PostCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    // protected $fillable = ['name','description'];      
    protected $guarded = [];

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
    
    protected static function booted(){
        
        static::created(function($post){
            Mail::to('yannaingaung@gmail.com')->send(new storedPost($post));
        });
        static::updated(function(){
            Mail::to('yannaingaung@gmail.com')->send(new PostCreated());
        });
    }
}
