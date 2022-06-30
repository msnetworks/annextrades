<?php

declare(strict_types=1);

namespace Square\Models;

/**
 * Represents a request to create a `Shift`
 */
class CreateShiftRequest implements \JsonSerializable
{
    /**
     * @var string|null
     */
    private $idempotencyKey;

    /**
     * @var Shift
     */
    private $shift;

    /**
     * @param Shift $shift
     */
    public function __construct(Shift $shift)
    {
        $this->shift = $shift;
    }

    /**
     * Returns Idempotency Key.
     *
     * Unique string value to insure the idempotency of the operation.
     */
    public function getIdempotencyKey(): ?string
    {
        return $this->idempotencyKey;
    }

    /**
     * Sets Idempotency Key.
     *
     * Unique string value to insure the idempotency of the operation.
     *
     * @maps idempotency_key
     */
    public function setIdempotencyKey(?string $idempotencyKey): void
    {
        $this->idempotencyKey = $idempotencyKey;
    }

    /**
     * Returns Shift.
     *
     * A record of the hourly rate, start, and end times for a single work shift
     * for an employee. May include a record of the start and end times for breaks
     * taken during the shift.
     */
    public function getShift(): Shift
    {
        return $this->shift;
    }

    /**
     * Sets Shift.
     *
     * A record of the hourly rate, start, and end times for a single work shift
     * for an employee. May include a record of the start and end times for breaks
     * taken during the shift.
     *
     * @required
     * @maps shift
     */
    public function setShift(Shift $shift): void
    {
        $this->shift = $shift;
    }

    /**
     * Encode this object to JSON
     *
     * @return mixed
     */
    public function jsonSerialize()
    {
        $json = [];
        $json['idempotency_key'] = $this->idempotencyKey;
        $json['shift']          = $this->shift;

        return array_filter($json, function ($val) {
            return $val !== null;
        });
    }
}
