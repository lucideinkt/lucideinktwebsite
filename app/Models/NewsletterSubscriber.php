<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    protected $fillable = [
        'email',
        'token',
        'confirmation_token',
        'status',
        'subscribed_at',
        'unsubscribed_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    // Scopes
    public function scopeSubscribed($query)
    {
        return $query->where('status', 'subscribed');
    }

    public function scopeUnsubscribed($query)
    {
        return $query->where('status', 'unsubscribed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Methods
    public function isSubscribed(): bool
    {
        return $this->status === 'subscribed';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function confirm(): void
    {
        $this->update([
            'status' => 'subscribed',
            'subscribed_at' => now(),
            'confirmation_token' => null,
        ]);
    }

    public function subscribe(): void
    {
        $this->update([
            'status' => 'subscribed',
            'subscribed_at' => now(),
            'unsubscribed_at' => null,
        ]);
    }

    public function unsubscribe(): void
    {
        $this->update([
            'status' => 'unsubscribed',
            'unsubscribed_at' => now(),
        ]);
    }

    // Generate unique token
    public static function generateToken(): string
    {
        do {
            $token = Str::random(32);
        } while (self::where('token', $token)->exists());

        return $token;
    }

    // Generate unique confirmation token
    public static function generateConfirmationToken(): string
    {
        do {
            $token = Str::random(64);
        } while (self::where('confirmation_token', $token)->exists());

        return $token;
    }

    // Boot method to auto-generate token
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscriber) {
            if (empty($subscriber->token)) {
                $subscriber->token = self::generateToken();
            }
        });
    }
}
