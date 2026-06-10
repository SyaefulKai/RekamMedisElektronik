<?php

namespace App\Enums;

enum DiagnosisRole: string
{
    case PRINCIPAL = 'principal';
    case SECONDARY = 'secondary';
    case ADMITTING = 'admitting';
    case BILLING   = 'billing';

    // -------------------------------------------------------------------------
    // Label bahasa Indonesia
    // -------------------------------------------------------------------------
    public function label(): string
    {
        return match($this) {
            self::PRINCIPAL => 'Diagnosis Utama',
            self::SECONDARY => 'Diagnosis Sekunder',
            self::ADMITTING => 'Diagnosis Masuk',
            self::BILLING   => 'Diagnosis Billing',
        };
    }

    // -------------------------------------------------------------------------
    // Mapping ke FHIR Encounter.diagnosis.use
    // CodeSystem: http://terminology.hl7.org/CodeSystem/diagnosis-role
    // -------------------------------------------------------------------------
    public function toFhirCode(): string
    {
        return match($this) {
            self::PRINCIPAL => 'DD',      // Discharge Diagnosis → diagnosis akhir/utama
            self::SECONDARY => 'CM',      // Comorbidity → penyakit penyerta
            self::ADMITTING => 'AD',      // Admission Diagnosis → diagnosis saat masuk
            self::BILLING   => 'billing', // Billing → untuk klaim asuransi/BPJS
        };
    }

    public function toFhirDisplay(): string
    {
        return match($this) {
            self::PRINCIPAL => 'Discharge Diagnosis',
            self::SECONDARY => 'Comorbidity',
            self::ADMITTING => 'Admission Diagnosis',
            self::BILLING   => 'Billing',
        };
    }

    // -------------------------------------------------------------------------
    // Build FHIR CodeableConcept — siap masuk ke Encounter.diagnosis.use
    // -------------------------------------------------------------------------
    public function toFhirCodeableConcept(): array
    {
        return [
            'coding' => [
                [
                    'system'  => 'http://terminology.hl7.org/CodeSystem/diagnosis-role',
                    'code'    => $this->toFhirCode(),
                    'display' => $this->toFhirDisplay(),
                ],
            ],
            'text' => $this->label(),
        ];
    }

    // -------------------------------------------------------------------------
    // Reverse mapping: dari kode FHIR kembali ke enum
    // -------------------------------------------------------------------------
    public static function fromFhirCode(string $fhirCode): self
    {
        return match($fhirCode) {
            'DD'      => self::PRINCIPAL,
            'CM'      => self::SECONDARY,
            'AD'      => self::ADMITTING,
            'billing' => self::BILLING,
            default   => throw new \ValueError("FHIR code '{$fhirCode}' tidak dikenali."),
        };
    }

    // -------------------------------------------------------------------------
    // Mapping ke INA-CBGs / BPJS
    // -------------------------------------------------------------------------
    public function toBpjsRole(): string
    {
        return match($this) {
            self::PRINCIPAL => 'UTAMA',
            self::SECONDARY => 'SEKUNDER',
            self::ADMITTING => 'MASUK',
            self::BILLING   => 'BILLING',
        };
    }
}
