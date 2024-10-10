<?php

namespace App;

enum UserRegistrationStatusEnum : string
{
    case NOT_REGISTERED = 'Not registered';
    case NOT_SCHEDULED = 'Not scheduled';
    case SCHEDULED = 'Scheduled';
    case VACCINATED = 'Vaccinated';
}
