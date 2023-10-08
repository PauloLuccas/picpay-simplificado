<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static create(array $user)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'document',
        'email',
        'password',
        'balance',
        'userType',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'firstName' => 'string',
        'lastName' => 'string',
        'email' => 'string',
        'document' => 'string',
        'balance' => 'int',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'userType' => UserType::class
    ];

    public function transactionsSender(): HasMany
    {
        return $this->hasMany(Transaction::class, 'sender_id');
    }

    public function transactionsReceiver(): HasMany
    {
        return $this->hasMany(Transaction::class, 'receiver_id');
    }
}
