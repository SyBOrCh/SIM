<?php

namespace Tests\Setup;

use App\User;
use App\Bundle;
use App\Project;
use App\Compound;

class ProjectFactory
{
    protected $compoundCount = 0;

    protected $user;

    protected $bundle;

    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    public function inBundle($bundle)
    {
        $this->bundle = $bundle;
    }

    public function withCompounds($count)
    {
        $this->compoundCount = $count;

        return $this;
    }

    public function create()
    {
        $user = $this->user ?? factory(User::class)->create();

        $bundle = $this->bundle ?? factory(Bundle::class)->create(['user_id' => $user->id]);

        $project = factory(Project::class)->create(['bundle_id' => $bundle->id]);

        factory(Compound::class, $this->compoundCount)->create(['project_id' => $project]);

        return $project;
    }
}
