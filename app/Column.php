// ...
class Column extends Model
{
    protected $fillable = [‘title’, ‘slug’, ‘order’];

    public $timestamps = false;

    public function tasks()
    {
        return $this->hasMany(Card::class)->orderBy('order');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}