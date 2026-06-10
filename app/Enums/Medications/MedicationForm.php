<?php

namespace App\Enums\Medications;

enum MedicationForm: string
{
	case TABLET      = 'tablet';
	case CAPSULE     = 'capsule';
	case SYRUP       = 'syrup';
	case INJECTION   = 'injection';
	case OINTMENT    = 'ointment';
	case CREAM       = 'cream';
	case GEL         = 'gel';
	case SUPPOSITORY = 'suppository';
	case DROPS       = 'drops';
	case INHALER     = 'inhaler';
	case PATCH       = 'patch';
	case POWDER      = 'powder';
	case OTHER       = 'other';

	public function label(): string
	{
		return match($this) {
			self::TABLET      => 'Tablet',
			self::CAPSULE     => 'Kapsul',
			self::SYRUP       => 'Sirup',
			self::INJECTION   => 'Injeksi',
			self::OINTMENT    => 'Salep',
			self::CREAM       => 'Krim',
			self::GEL         => 'Gel',
			self::SUPPOSITORY => 'Suppositoria',
			self::DROPS       => 'Tetes',
			self::INHALER     => 'Inhaler',
			self::PATCH       => 'Patch',
			self::POWDER      => 'Serbuk',
			self::OTHER       => 'Lainnya',
		};
	}

	public static function options(): array
	{
		return collect(self::cases())
			->mapWithKeys(fn($case) => [$case->value => $case->label()])
			->toArray();
	}

	public static function fromOrDefault(string $value): self
	{
		return self::tryFrom($value) ?? self::OTHER;
	}
}
