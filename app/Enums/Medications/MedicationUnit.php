<?php

namespace App\Enums\Medications;

enum MedicationUnit: string
{
	case MG      = 'mg';
	case GRAM    = 'g';
	case ML      = 'ml';
	case IU      = 'iu';
	case TABLET  = 'tablet';
	case CAPSULE = 'capsule';
	case AMPOULE = 'ampoule';
	case BOTTLE  = 'bottle';
	case SACHET  = 'sachet';
	case TUBE    = 'tube';
	case OTHER   = 'other';

	public function label(): string
	{
		return match($this) {
			self::MG      => 'mg',
			self::GRAM    => 'g',
			self::ML      => 'ml',
			self::IU      => 'IU',
			self::TABLET  => 'Tablet',
			self::CAPSULE => 'Kapsul',
			self::AMPOULE => 'Ampul',
			self::BOTTLE  => 'Botol',
			self::SACHET  => 'Sachet',
			self::TUBE    => 'Tube',
			self::OTHER   => 'Lainnya',
		};
	}

	public function isMetric(): bool
	{
		return match($this) {
			self::MG, self::GRAM, self::ML => true,
			default                        => false,
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
