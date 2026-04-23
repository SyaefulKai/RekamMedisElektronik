<?php

namespace App\Enums;

enum PractitionerType: string
{
    case DOCTOR = 'doctor';
    case NURSE = 'nurse';
    case MIDWIFE = 'midwife';
    case PHARMACIST = 'pharmacist';
    case DENTIST = 'dentist';
}
