<?php

namespace App\Enums;

enum CodeSystem: string
{
    case ICD10 = 'http://hl7.org/fhir/sid/icd-10';
    case SNOMED = 'http://snomed.info/sct';
    case ICD9 = 'http://hl7.org/fhir/sid/icd-9-cm';
}
