<?php

namespace KABBOUCHI;

use Brick\Math\BigDecimal;

class BigNumber implements \JsonSerializable
{
    private BigDecimal $value;
    private int $scale = 18;

    final public function __construct(string|int|float|BigNumber $value)
    {
        $stringValue = (string) $value;

        if (is_string($value) && preg_match('/^0x[0-9a-fA-F]+$/', $value)) {
            $stringValue = (string) hexdec($value);
        }

        $this->value = BigDecimal::ofUnscaledValue($stringValue * (10 ** $this->scale), $this->scale);
    }

    public static function of(string|int|float|BigNumber $value): self
    {
        return new static($value);
    }

    public function plus(string|int|float|BigNumber $value): self
    {
        return new static(BigDecimal::sum($this->value, (string) $value));
    }

    public function minus(string|int|float|BigNumber $value): self
    {
        return new static($this->value->minus((string) $value));
    }

    public function multipliedBy(string|int|float|BigNumber $value): self
    {
        return new static($this->value->multipliedBy($value));
    }

    public function times(string|int|float|BigNumber $value): self
    {
        return $this->multipliedBy($value);
    }

    public function dividedBy(string|int|float|BigNumber $value): self
    {
        return new static($this->value->dividedBy($value, null, 2));
    }

    public function div(string|int|float|BigNumber $value): self
    {
        return $this->dividedBy($value);
    }

    public function exponentiatedBy(string|int|float|BigNumber $value): self
    {
        return new static($this->value->power((int) self::of($value)->toFixed(0)));
    }

    public function pow(string|int|float|BigNumber $value): self
    {
        return $this->exponentiatedBy($value);
    }

    public function modulo(string|int|float|BigNumber $value): self
    {
        return new static($this->value->remainder((string) $value));
    }

    public function mod(string|int|float|BigNumber $value): self
    {
        return $this->modulo($value);
    }

    public function absoluteValue(): self
    {
        return $this->isNegative() ? $this->negated() : new static($this);
    }

    public function abs(): self
    {
        return $this->absoluteValue();
    }

    public static function maximum(string|int|float|BigNumber ...$values): self
    {
        return new static(BigDecimal::max(...array_map(fn ($value) => (string) $value, $values)));
    }

    public static function max(string|int|float|BigNumber ...$values): self
    {
        return static::maximum(...$values);
    }

    public static function minimum(string|int|float|BigNumber ...$values): self
    {
        return new static(BigDecimal::min(...array_map(fn ($value) => (string) $value, $values)));
    }

    public static function min(string|int|float|BigNumber ...$values): self
    {
        return static::minimum(...$values);
    }

    public static function sum(string|int|float|BigNumber ...$values): self
    {
        return new static(BigDecimal::sum(...array_map(fn ($value) => (string) $value, $values)));
    }

    public function isZero(): bool
    {
        return $this->value->isZero();
    }

    public function isPositive(): bool
    {
        return $this->value->isPositive();
    }

    public function isGreaterThan(string|int|float|BigNumber $value): bool
    {
        return $this->value->isGreaterThan((string) $value);
    }

    public function isGreaterThanOrEqualTo(string|int|float|BigNumber $value): bool
    {
        return $this->value->isGreaterThanOrEqualTo((string) $value);
    }

    public function isLessThan(string|int|float|BigNumber $value): bool
    {
        return $this->value->isLessThan((string) $value);
    }

    public function isLessThanOrEqualTo(string|int|float|BigNumber $value): bool
    {
        return $this->value->isLessThanOrEqualTo((string) $value);
    }

    public function isEqualTo(string|int|float|BigNumber $value): bool
    {
        return $this->value->isEqualTo((string) $value);
    }

    public function negated(): self
    {
        return $this->times(-1);
    }

    public function isNegative(): bool
    {
        return $this->value->isNegative();
    }

    public function __toString(): string
    {
        return (string) $this->value->toFloat();
    }

    public function toString(): string
    {
        return $this->__toString();
    }

    public function toNumber(): int|float
    {
        $value = $this->toString();

        if (is_numeric($value)) {
            return $value + 0;
        }

        return 0;
    }

    public function toPrecision(int $significantDigits = null): string
    {
        if (!$significantDigits) {
            return $this->toString();
        }

        return $this->toFixed($significantDigits - 1);
    }

    public function toFixed(int $decimalPlaces = null): string
    {
        $value = $this->toString();

        if (is_null($decimalPlaces)) {
            return $value;
        }

        return number_format(floatval($value), $decimalPlaces);
    }

    public function jsonSerialize(): string
    {
       return $this->toString();
    }
}
