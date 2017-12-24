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
            $item = [
                'user' => $audit->user->name,
                'date' => $audit->created_at->getTimestamp() * 1000,
            ];

            if ($audit->event === 'created') {
                $item['event'] = 'created the project';
            }

            if ($audit->event === 'updated') {
                foreach ($audit->new_values as $index => $value) {
                    switch ($index) {
                        case 'customer_id':
                            $newCustomer = Customer::find($value);
                            $oldCustomer = Customer::find($audit->old_values[$index]);

                            $item['event'] = ' updated Customer to ' . $newCustomer->getCompanyName() . ' from ' . $oldCustomer->getCompanyName();

                            break;
                        case 'manager_id':
                            $newManager = User::find($value);
                            $oldManager = User::find($audit->old_values[$index]);

                            $item['event'] = ' updated Manager to ' . $newManager->getName() . ' from ' . $oldManager->getName();

                            break;
                        default:
                            $item['event'] = 'updated ' . ucwords($index) . ' to ' . $value . ' from ' . $audit->old_values[$index];

                            break;
                    }
                }

            }

            $history[] = $item;
        }

        $viewModel = new ProjectDetailViewModel(
            $model->getId(),
            $model->getName(),
            $model->getManager()->getName(),
            $model->getStatus(),
            $customer,
            $history
        );

        return $viewModel;
    }
}