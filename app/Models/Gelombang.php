<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class   Gelombang extends Model
    {
        protected $guarded = [];

        public function pendaftaran()
        {
            return $this->hasMany(Pendaftaran::class);
        }
    }