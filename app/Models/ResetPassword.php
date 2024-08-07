<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;
    protected $table="reset_password";
    protected $fillable = ['email','token'];

    public function customer(){
        return $this->hasOne(DangNhapUser::class,'email','email');
    }
    public function scopeCheckToken($q,$token){
        return $q->where('token',$token)->firstOrFail();
    }
}
