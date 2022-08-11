<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\FavoriteShop;
use App\Notifications\VerifyEmail; 

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    //メール認証設定（breezeデフォルト）
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Shopテーブルと多対多のリレーションを作成
    public function favorite_shops()
    {
        return $this->belongsToMany('App\Models\Shop','favorite_shops','user_id', 'shop_id');
    }

    //ユーザ情報から、お気に入り店舗のチェック
    public function is_favorite($shop_id)
    {
        return FavoriteShop::where([
            ['user_id', $this->id],
            ['shop_id', $shop_id]
        ])->exists();
    }

    //管理画面実装に伴いroleテーブルリレーション追加　
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    //メール認証メソッド（オーバーライド）
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

}
