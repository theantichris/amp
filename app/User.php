<?php

namespace AMP;

use AMP\Domain\Project\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Spark\CanJoinTeams;
use Laravel\Spark\User as SparkUser;
use OwenIt\Auditing\Contracts\UserResolver;

class User extends SparkUser implements UserResolver
{
    use CanJoinTeams;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'authy_id',
        'country_code',
        'phone',
        'card_brand',
        'card_last_four',
        'card_country',
        'billing_address',
        'billing_address_line_2',
        'billing_city',
        'billing_zip',
        'billing_country',
        'extra_billing_information',
    ];

    protected $casts = [
        'trial_ends_at'        => 'date',
        'uses_two_factor_auth' => 'boolean',
    ];

    protected $dates = ['deleted_at'];

    public static function resolveId()
    {
        return \Auth::check() ? \Auth::user()->getAuthIdentifier() : null;
    }

    public function getId(): ?int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function getTeamId(): int
    {
        return $this->attributes['team_id'];
    }

    /**
     * @return HasMany|Project[]
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'id', 'manager_id');
    }
}
