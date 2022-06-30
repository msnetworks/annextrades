
# Accumulate Loyalty Points Request

A request to accumulate points for a purchase.

## Structure

`AccumulateLoyaltyPointsRequest`

## Fields

| Name | Type | Description | Getter | Setter |
|  --- | --- | --- | --- | --- |
| `accumulatePoints` | [`LoyaltyEventAccumulatePoints`](/doc/models/loyalty-event-accumulate-points.md) | Provides metadata when the event `type` is `ACCUMULATE_POINTS`. | getAccumulatePoints(): LoyaltyEventAccumulatePoints | setAccumulatePoints(LoyaltyEventAccumulatePoints accumulatePoints): void |
| `idempotencyKey` | `string` | A unique string that identifies the `AccumulateLoyaltyPoints` request.<br>Keys can be any valid string but must be unique for every request. | getIdempotencyKey(): string | setIdempotencyKey(string idempotencyKey): void |
| `locationId` | `string` | The [location](#type-Location) where the purchase was made. | getLocationId(): string | setLocationId(string locationId): void |

## Example (as JSON)

```json
{
  "accumulate_points": {
    "order_id": "RFZfrdtm3mhO1oGzf5Cx7fEMsmGZY"
  },
  "idempotency_key": "58b90739-c3e8-4b11-85f7-e636d48d72cb",
  "location_id": "P034NEENMD09F"
}
```

