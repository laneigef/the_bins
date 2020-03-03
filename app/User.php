<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'bingo_issuers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'name', 'email', 'password',
        'login_id', 'password', 'bingo_type', 'self_issue_flag',
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

    public function bingo_cards()
    {
        return $this->hasMany('App\BingoCards');
    }

    public function update_issuer($request)
    {
        $bingo_issuer = User::find(Auth::id());
        // フォーム値を入れる
        $bingo_issuer->fill($request->all());
        if (empty($bingo_issuer->password)) {
            $bingo_issuer->password = Auth::user()->password;
        }
        $bingo_issuer->save();

       return $bingo_issuer;
    }

    public function insert_issuer($request)
    {
        
    }
}
