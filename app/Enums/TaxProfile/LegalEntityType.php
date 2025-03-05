<?php

namespace App\Enums\TaxProfile;

enum LegalEntityType: string
{
    case PHISICAL_PERSONS = 'phisical_persons';
    case PARTNERSHIPS = 'partnerships';
    case CORPORATE_ENTITIES = 'corporate_entities';
    case COOPERATIVE_STRUCTURES = 'cooperative_structures';
}
