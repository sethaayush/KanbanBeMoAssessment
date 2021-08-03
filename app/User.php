// ...
class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function statuses()
    {
        return $this->hasMany(Status::class)->orderBy('order');
    }

    protected static function booted()
    {
        static::created(function ($user) {
            // Create default columns
            $user->columns()->createMany([
                [
                    'title' => 'Backlog',
                    'slug' => 'backlog',
                    'order' => 1
                ],
                [
                    'title' => 'Up Next',
                    'slug' => 'up-next',
                    'order' => 2
                ],
                [
                    'title' => 'In Progress',
                    'slug' => 'in-progress',
                    'order' => 3
                ],
                [
                    'title' => 'Done',
                    'slug' => 'done',
                    'order' => 4
                ]
            ]);
        });
    }
}