<?php

namespace AMP\Service\Project;

use AMP\Domain\Customer\Customer;
use AMP\Domain\Project\Project;
use AMP\Team;
use AMP\User;

class EloquentProjectService implements ProjectServiceInterface
{
    public function createFromJson(string $json, Team $team): Project
    {
        $project = new Project();
        $project->team()->associate($team);

        $data = json_decode($json, true);
        $project->fill($data);

        if ($data['customer']) {
            $project->customer()->associate(Customer::find($data['customer']['id']));
        }

        $project->manager()->associate(User::find($data['manager']['id']));

        $project->save();

        return $project;
    }

    public function updateFromJson(string $json, int $id): Project
    {
        $project = Project::find($id);
        $data    = json_decode($json, true);

        if ($data['customer']) {
            $project->customer()->associate(Customer::find($data['customer']['id']));
        } else {
            $project->customer()->dissociate();
        }

        $project->manager()->associate(User::find($data['manager']['id']));

        $project->update($data);

        return $project;
    }
}