
# Create Break Type Request

A request to create a new `BreakType`

## Structure

`CreateBreakTypeRequest`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `idempotencyKey` | `?string` | Optional | Unique string value to insure idempotency of the operation | getIdempotencyKey(): ?string | setIdempotencyKey(?string idempotencyKey): void |
| `breakType` | [`BreakType`](/doc/models/break-type.md) |  | A defined break template that sets an expectation for possible `Break`<br>instances on a `Shift`. | getBreakType(): BreakType | setBreakType(BreakType breakType): void |

## Example (as JSON)

```json
{
  "break_type": {
    "break_name": "Lunch Break",
    "expected_duration": "PT30M",
    "is_paid": true,
    "location_id": "CGJN03P1D08GF"
  },
  "idempotency_key": "PAD3NG5KSN2GL"
}
```

