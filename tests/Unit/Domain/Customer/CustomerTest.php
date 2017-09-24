<?php

namespace Tests\Unit\Domain\Customer;

use AMP\Domain\Customer\Customer;
use InvalidArgumentException;

class CustomerTest extends \TestCase
{
    /** @var  Customer */
    private $uut;

    public function setUp()
    {
        $this->uut = new Customer();
    }

    /** @test */
    public function has_account_number()
    {
        $accountNumber = 'abc123';

        $this->uut->setAccountNumber($accountNumber);

        $this->assertEquals($accountNumber, $this->uut->getAccountNumber());
    }

    /** @test */
    public function has_company_name()
    {
        $companyName = 'Additerra, Inc.';

        $this->uut->setCompanyName($companyName);

        $this->assertEquals($companyName, $this->uut->getCompanyName());
    }

    /** @test */
    public function has_contact_name()
    {
        $contactName = 'Christopher Lamm';

        $this->uut->setContactName($contactName);

        $this->assertEquals($contactName, $this->uut->getContactName());
    }

    /** @test */
    public function has_contact_email()
    {
        $contactEmail = 'chrislamm@additerra.com';

        $this->uut->setContactEmail($contactEmail);

        $this->assertEquals($contactEmail, $this->uut->getContactEmail());
    }

    /** @test */
    public function rejects_invalid_email()
    {
        $contactEmail = 'chrislamm';

        $this->expectException(InvalidArgumentException::class);

        $this->uut->setContactEmail($contactEmail);
    }

    /** @test */
    public function has_contact_phone()
    {
        $contactPhone = '(555) 555-5555';

        $this->uut->setContactPhone($contactPhone);

        $this->assertEquals($contactPhone, $this->uut->getContactPhone());
    }

    /** @test */
    public function has_address()
    {
        $address1 = '123 Road St.';

        $this->uut->setAddress1($address1);

        $this->assertEquals($address1, $this->uut->getAddress1());
    }

    /** @test */
    public function has_address_second_line()
    {
        $address2 = 'Suite 100';

        $this->uut->setAddress2($address2);

        $this->assertEquals($address2, $this->uut->getAddress2());
    }

    /** @test */
    public function has_city()
    {
        $city = 'Knoxville';

        $this->uut->setCity($city);

        $this->assertEquals($city, $this->uut->getCity());
    }

    /** @test */
    public function has_state()
    {
        $state = 'TN';

        $this->uut->setState($state);

        $this->assertEquals($state, $this->uut->getState());
    }

    /** @test */
    public function rejects_invalid_state()
    {
        $state = 'BUTTS';

        $this->expectException(InvalidArgumentException::class);

        $this->uut->setState($state);
    }

    /** @test */
    public function has_zip()
    {
        $zip = '37918';

        $this->uut->setZip($zip);

        $this->assertEquals($zip, $this->uut->getZip());
    }

    /** @test */
    public function has_shipping_account_provider()
    {
        $shippingAccountProvider = 'UPS';

        $this->uut->setShippingAccountProvider($shippingAccountProvider);

        $this->assertEquals($shippingAccountProvider, $this->uut->getShippingAccountProvider());
    }

    /** @test */
    public function has_shipping_account_number()
    {
        $shippingAccountNumber = 'UPS';

        $this->uut->setShippingAccountNumber($shippingAccountNumber);

        $this->assertEquals($shippingAccountNumber, $this->uut->getShippingAccountNumber());
    }
}
