<?php

namespace App\Enums;

enum DiagnosisStatus: string
{
    case PROVISIONAL   = 'provisional';
    case DIFFERENTIAL  = 'differential';
    case CONFIRMED     = 'confirmed';
    case REFUTED       = 'refuted';

    // -------------------------------------------------------------------------
    // Label bahasa Indonesia
    // -------------------------------------------------------------------------
    public function label(): string
    {
        return match($this) {
            self::PROVISIONAL  => 'Diagnosis Sementara',
            self::DIFFERENTIAL => 'Diagnosis Banding',
            self::CONFIRMED    => 'Diagnosis Terkonfirmasi',
            self::REFUTED      => 'Diagnosis Disangkal',
        };
    }

    public function description(): string
    {
        return match($this) {
            self::PROVISIONAL  => 'Working diagnosis, belum dikonfirmasi',
            self::DIFFERENTIAL => 'Masih dalam pertimbangan diferensial',
            self::CONFIRMED    => 'Sudah dikonfirmasi secara klinis atau pemeriksaan',
            self::REFUTED      => 'Terbukti bukan diagnosis ini',
        };
    }

    // -------------------------------------------------------------------------
    // Mapping ke FHIR Condition.verificationStatus
    // CodeSystem: http://terminology.hl7.org/CodeSystem/condition-ver-status
    // -------------------------------------------------------------------------
    public function toFhirCode(): string
    {
        return match($this) {
            self::PROVISIONAL  => 'provisional',
            self::DIFFERENTIAL => 'differential',
            self::CONFIRMED    => 'confirmed',
            self::REFUTED      => 'refuted',
        };
    }

    public function toFhirDisplay(): string
    {
        return match($this) {
            self::PROVISIONAL  => 'Provisional',
            self::DIFFERENTIAL => 'Differential',
            self::CONFIRMED    => 'Confirmed',
            self::REFUTED      => 'Refuted',
        };
    }

    // -------------------------------------------------------------------------
    // Build FHIR CodeableConcept — siap masuk ke Condition.verificationStatus
    // -------------------------------------------------------------------------
    public function toFhirCodeableConcept(): array
    {
        return [
            'coding' => [
                [
                    'system'  => 'http://terminology.hl7.org/CodeSystem/condition-ver-status',
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
            'provisional'  => self::PROVISIONAL,
            'differential' => self::DIFFERENTIAL,
            'confirmed'    => self::CONFIRMED,
            'refuted'      => self::REFUTED,
            default        => throw new \ValueError("FHIR verificationStatus '{$fhirCode}' tidak dikenali."),
        };
    }
}
