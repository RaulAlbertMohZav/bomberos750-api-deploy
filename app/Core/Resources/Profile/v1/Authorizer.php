<?php

namespace App\Core\Resources\Profile\v1;

use App\Core\Resources\Profile\v1\Interfaces\ProfileInterface;

class Authorizer implements ProfileInterface
{
    protected SchemaJson $schemaJson;

    public function __construct(SchemaJson $schemaJson)
    {
        $this->schemaJson = $schemaJson;
    }

    public function getDataMyProfile()
    {
        return $this->schemaJson->getDataMyProfile();
    }

    public function updateDataMyProfile($request)
    {
        return $this->schemaJson->updateDataMyProfile($request);
    }

    public function unsubscribeFromSystem()
    {
        return $this->schemaJson->unsubscribeFromSystem();
    }

    public function changePasswordAuth($request)
    {
        return $this->schemaJson->changePasswordAuth($request);
    }

    public function getNotificationsUser()
    {
        return $this->schemaJson->getNotificationsUser();
    }

    public function read_notification_user($notification_id)
    {
        return $this->schemaJson->read_notification_user($notification_id);
    }
}
