<?php

namespace AMP\Map\Project;

use AMP\Domain\BaseModel;
use AMP\Domain\Customer\Customer;
use AMP\Domain\Project\Project;
use AMP\Map\DetailViewModelMapperInterface;
use AMP\User;
use AMP\ViewModel\Project\ProjectDetailViewModel;
use AMP\ViewModel\ViewModel;

class ProjectDetailViewModelMapper implements DetailViewModelMapperInterface
{
    public function map(BaseModel $model): ViewModel
    {
        /** @var Project $model */

        if ($model->getCustomer()) {
            $customer = $model->getCustomer()->getCompanyName();
        } else {
            $customer = 'Internal';
        }

        $history = [];
        /** @noinspection PhpUndefinedMethodInspection */
        foreach ($model->audits()->get() as $audit) {
            if ($audit->event === 'created') {
                $history[] = $audit->user->name . ' created the project on ' . $audit->created_at;
            }

            if ($audit->event === 'updated') {
                foreach ($audit->new_values as $index => $value) {
                    switch ($index) {
                        case 'customer_id':
                            $newCustomer = Customer::find($value);
                            $oldCustomer = Customer::find($audit->old_values[$index]);

                            $history[] = $audit->user->name . ' updated Customer to ' . $newCustomer->getCompanyName() . ' from ' . $oldCustomer->getCompanyName() . ' on ' . $audit->created_at;

                            break;
                        case 'manager_id':
                            $newManager = User::find($value);
                            $oldManager = User::find($audit->old_values[$index]);

                            $history[] = $audit->user->name . ' updated Manager to ' . $oldManager->getName() . ' from ' . $newManager->getName() . ' on ' . $audit->created_at;

                            break;
                        default:
                            $history[] = $audit->user->name . ' updated ' . ucwords($index) . ' to ' . $value . ' from ' . $audit->old_values[$index] . ' on ' . $audit->created_at;

                            break;
                    }
                }

            }
        }

        $comments = [];
        foreach ($model->comments()->get() as $comment) {
            $comments[] = [
                'id' => $comment->id,
                'body' => $comment->body,
                'updatedAt' => $comment->updated_at,
                'createdBy' => User::find($comment->creator_id)->getName(),
            ];
        }

        $viewModel = new ProjectDetailViewModel(
            $model->getId(),
            $model->getName(),
            $model->getManager()->getName(),
            $model->getStatus(),
            $customer,
            $history,
            $comments
        );

        return $viewModel;
    }
}