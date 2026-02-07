<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $primaryKey = 'key';
    public $incrementing = false;

    protected $fillable = [
        'key',
        'value',
        'serialize',
    ];

    public static function getValue($key)
    {
        $value_data = Setting::find($key);
        if($value_data['serialize']){
            $value = unserialize($value_data['value']);
        }
        else{
            $value = $value_data['value'];
        }
        return $value;
    }

    public static function setValue($value)
    {
        $value_key = array_keys($value);
        foreach($value_key as $key){
            $value_data = Setting::find($key);
            if($value_data['serialize']){
                $value_data->value = serialize($value[$key]);
            }
            else{
                if($key == "favicon"){
                    $link_upload_image = $value['favicon']->store('favicon');
                    $value_data->value = asset('storage/'.$link_upload_image);
                }else{
                    $value_data->value = $value[$key];
                }
            }
            $value_data->save();
        }
    }
}
