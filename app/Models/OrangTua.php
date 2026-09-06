<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model 
    {
        protected $guarded = [];

        public function pendaftaran()
        {
            return $this->belongsTo(Pendaftaran::class);
        }
    }