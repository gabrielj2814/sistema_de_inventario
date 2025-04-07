<?php

namespace App\Listeners;

use App\Events\CreatedCustomerEvent;
use App\Services\CompanyServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use InvalidArgumentException;

class CreateCustomerCompanyListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected CompanyServices $companyServices
    )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreatedCustomerEvent $event): void
    {

        $company=$this->companyServices->creatCompany($event->companyData);
        $customerCompany=$this->companyServices->assignCompany($event->user->id,$company->id);

        if($customerCompany==null){
            throw new InvalidArgumentException("the assign company to customer is can't null");
        }

    }
}
