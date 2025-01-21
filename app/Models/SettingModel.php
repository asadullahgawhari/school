<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    use HasFactory;

    protected $table = 'setting';

    static public function getSingle()
    {
        return self::find(1);
    }

    public function getLogo()
    {
        if (!empty($this->logo) && file_exists('public/dist/img/setting/'.$this->logo)) 
        {
            return url('public/dist/img/setting/'.$this->logo);
        }
        else
        {
            return '';
        }    
    }

    public function getFevicon()
    {
        if (!empty($this->fevicon) && file_exists('public/dist/img/setting/'.$this->fevicon)) 
        {
            return url('public/dist/img/setting/'.$this->fevicon);
        }
        else
        {
            return '';
        }    
    }
}
