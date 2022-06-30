<?php namespace App;

use Carbon\Carbon;
use Common\Domains\CustomDomain;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * App\Project
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $uuid
 * @property int $published
 * @property int $public
 * @property string $framework
 * @property string $template
 * @property string $theme
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|BuilderPage[] $pages
 * @property-read Collection|User[] $users
 * @mixin \Eloquent
 */
class Project extends Eloquent {

	protected $guarded = ['id'];

	public function pages()
    {
        return $this->morphMany(BuilderPage::class, 'pageable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_projects', 'project_id', 'user_id');
    }

    public function domain()
    {
        return $this->morphOne(CustomDomain::class, 'resource')
            ->select('id', 'host', 'resource_id', 'resource_type');
    }
}
