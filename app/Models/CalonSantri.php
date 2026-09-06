<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalonSantri extends Model 
    {
        protected $guarded = [];

        public function pendaftaran()
        {
            return $this->elongsTo(Pendaftaran::class);
        }
    }