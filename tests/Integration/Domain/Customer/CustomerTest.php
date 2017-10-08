<?php

namespace Tests\Integration\Domain\Customer;

use AMP\Domain\Customer\Customer;
use AMP\Enum\StateAbbreviation;
use AMP\Team;
use AMP\User;
use Tests\IntegrationTest;

class CustomerTest extends IntegrationTest
{
    private $accountNumber = 'abc123';
    private $companyName = 'Additerra, Inc.';
    private $contactName = 'Christopher Lamm';
    private $contactEmail = 'chrislamm@additerra.com';

    public function setUp()
    {
        parent::setUp();

        factory(User::class)->create();
        factory(Team::class)->create(['owner_id' => User::first()->getQueueableId()]);
    }

    /** @test */
    public function it_save_and_fetches_account_number()
    {
        $customer = new Customer();
        $customer->team()->associate(Team::first());
        $customer->setAccountNumber($this->accountNumber)
                 ->setCompanyName($this->companyName)
                 ->setContactName($this->contactName)
                 ->setContactEmail($this->contactEmail);

        $customer->save();

        $this->assertEquals($this->accountNumber, Customer::first()->getAccountNumber());
    }

    /** @test */
    public function it_save_and_fetches_company_name()
    {
        $customer = new Customer();
        $customer->team()->associate(Team::first());
        $customer->setAccountNumber($this->accountNumber)
                 ->setCompanyName($this->companyName)
                 ->setContactName($this->contactName)
                 ->setContactEmail($this->contactEmail);

        $customer->save();

        $this->assertEquals($this->companyName, Customer::first()->getCompanyName());
    }

    /** @test */
    public function it_save_and_fetches_contact_name()
    {
        $customer = new Customer();
        $customer->team()->associate(Team::first());
        $customer->setAccountNumber($this->accountNumber)
                 ->setCompanyName($this->companyName)
                 ->setContactName($this->contactName)
                 ->setContactEmail($this->contactEmail);

        $customer->save();

        $this->assertEquals($this->contactName, Customer::first()->getContactName());
    }

    /** @test */
    public function it_save_and_fetches_contact_email()
    {
        $customer = new Customer();
        $customer->team()->associate(Team::first());
        $customer->setAccountNumber($this->accountNumber)
                 ->setCompanyName($this->companyName)
                 ->setContactName($this->contactName)
                 ->setContactEmail($this->contactEmail);

        $customer->save();

        $this->assertEquals($this->contactEmail, Customer::first()->getContactEmail());
    }

    /** @test */
    public function it_save_and_fetches_contact_phone()
    {
        $contactPhone = '555-555-5555';

        $customer = new Customer();
        $customer->team()->associate(Team::first());
        $customer->setAccountNumber($this->accountNumber)
                 ->setCompanyName($this->companyName)
                 ->setContactName($this->contactName)
                 ->setContactEmail($this->contactEmail)
                 ->setContactPhone($contactPhone);

        $customer->save();

        $this->assertEquals($contactPhone, Customer::first()->getContactPhone());
    }

    /** @test */
    public function it_save_and_fetches_address_1()
    {
        $address1 = '123 Road St';

        $customer = new Customer();
        $customer->team()->associate(Team::first());
        $customer->setAccountNumber($this->accountNumber)
                 ->setCompanyName($this->companyName)
                 ->setContactName($this->contactName)
                 ->setContactEmail($this->contactEmail)
                 ->setAddress1($address1);

        $customer->save();

        $this->assertEquals($address1, Customer::first()->getAddress1());
    }

    /** @test */
    public function it_save_and_fetches_address_2()
    {
        $address2 = 'Suite 1';

        $customer = new Customer();
        $customer->team()->associate(Team::first());
        $customer->setAccountNumber($this->accountNumber)
                 ->setCompanyName($this->companyName)
                 ->setContactName($this->contactName)
                 ->setContactEmail($this->contactEmail)
                 ->setAddress2($address2);

        $customer->save();

        $this->assertEquals($address2, Customer::first()->getAddress2());
    }

    /** @test */
    public function it_save_and_fetches_city()
    {
        $city = 'Knoxville';

        $customer = new Customer();
        $customer->team()->associate(Team::first());
        $customer->setAccountNumber($this->accountNumber)
                 ->setCompanyName($this->companyName)
                 ->setContactName($this->contactName)
                 ->setContactEmail($this->contactEmail)
                 ->setCity($city);

        $customer->save();

        $this->assertEquals($city, Customer::first()->getCity());
    }

    /** @test */
    public function it_save_and_fetches_state()
    {
        $state = StateAbbreviation::TENNESSEE;

        $customer = new Customer();
        $customer->team()->associate(Team::first());
        $customer->setAccountNumber($this->accountNumber)
                 ->setCompanyName($this->companyName)
                 ->setContactName($this->contactName)
                 ->setContactEmail($this->contactEmail)
                 ->setState($state);

        $customer->save();

        $this->assertEquals($state, Customer::first()->getState());
    }

    /** @test */
    public function it_save_and_fetches_zip()
    {
        $zip = '37918';

        $customer = new Customer();
        $customer->team()->associate(Team::first());
        $customer->setAccountNumber($this->accountNumber)
                 ->setCompanyName($this->companyName)
                 ->setContactName($this->contactName)
                 ->setContactEmail($this->contactEmail)
                 ->setZip($zip);

        $customer->save();

        $this->assertEquals($zip, Customer::first()->getZip());
    }

    /** @test */
    public function it_save_and_fetches_shipping_account_provider()
    {
        $shippingAccountProvider = 'UPS';

        $customer = new Customer();
        $customer->team()->associate(Team::first());
        $customer->setAccountNumber($this->accountNumber)
                 ->setCompanyName($this->companyName)
                 ->setContactName($this->contactName)
                 ->setContactEmail($this->contactEmail)
                 ->setShippingAccountProvider($shippingAccountProvider);

        $customer->save();

        $this->assertEquals($shippingAccountProvider, Customer::first()->getShippingAccountProvider());
    }

    /** @test */
    public function it_save_and_fetches_shipping_account_number()
    {
        $shippingAccountNumber = 'abc123';

        $customer = new Customer();
        $customer->team()->associate(Team::first());
        $customer->setAccountNumber($this->accountNumber)
                 ->setCompanyName($this->companyName)
                 ->setContactName($this->contactName)
                 ->setContactEmail($this->contactEmail)
                 ->setShippingAccountNumber($shippingAccountNumber);

        $customer->save();

        $this->assertEquals($shippingAccountNumber, Customer::first()->getShippingAccountNumber());
    }
}
