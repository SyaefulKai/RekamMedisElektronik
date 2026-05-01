<?php

namespace App\Enums;

enum DiagnosisSystem: string
{
    case ICD10 = 'http://hl7.org/fhir/sid/icd-10';
    case SNOMED = 'http://snomed.info/sct';
}
