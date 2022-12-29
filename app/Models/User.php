<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;
use Jamesh\Uuid\HasUuid;
use App\Models\Collection\DeveloperProject;
use App\Models\UserBri;
use Carbon\Carbon;
use DB;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'no_hp',
        'is_approved',
        'nama_developer',
        'nama_perumahan'
    ];
    protected $appends = ['badge_status'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'badge_status',
        'email_verified_at',
        // 'created_at',
        'updated_at',
        'is_approved'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s');
    }

    public function devProjectVerif(){
        return $this->hasMany(DeveloperProject::class, 'developer_id', 'id')->latest()->where('is_approved', 1);
    }

    public function devProjectNotVerif(){
        return $this->hasMany(DeveloperProject::class, 'developer_id', 'id')->latest()->where('is_approved', '!=', 1);
    }

    public function files(){
        return $this->hasOne(UserFile::class, 'user_id', 'id');
    }

    public function userBri(){
        return $this->hasOne(UserBri::class, 'user_id', 'id');
    }

    public function getBadgeStatusAttribute(){
        $span = '';
        if ($this->is_approved == 0) {
            $span = '<span class="badge badge-info">Belum dicek</span>';
        }elseif ($this->is_approved == 1) {
            $span = '<span class="badge badge-success">Terverifikasi</span>';
        }elseif ($this->is_approved == 2) {
            $span = '<span class="badge badge-danger">Ditolak verifikasi</span>';
        }
        return $span;
    }
}