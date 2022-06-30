
# M Break

A record of an employee's break during a shift.

## Structure

`MBreak`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `id` | `?string` | Optional | UUID for this object | getId(): ?string | setId(?string id): void |
| `startAt` | `string` |  | RFC 3339; follows same timezone info as `Shift`. Precision up to<br>the minute is respected; seconds are truncated. | getStartAt(): string | setStartAt(string startAt): void |
| `endAt` | `?string` | Optional | RFC 3339; follows same timezone info as `Shift`. Precision up to<br>the minute is respected; seconds are truncated. | getEndAt(): ?string | setEndAt(?string endAt): void |
| `breakTypeId` | `string` |  | The `BreakType` this `Break` was templated on. | getBreakTypeId(): string | setBreakTypeId(string breakTypeId): void |
| `name` | `string` |  | A human-readable name. | getName(): string | setName(string name): void |
| `expectedDuration` | `string` |  | Format: RFC-3339 P[n]Y[n]M[n]DT[n]H[n]M[n]S. The expected length of<br>the break. | getExpectedDuration(): string | setExpectedDuration(string expectedDuration): void |
| `isPaid` | `bool` |  | Whether this break counts towards time worked for compensation<br>purposes. | getIsPaid(): bool | setIsPaid(bool isPaid): void |

## Example (as JSON)

```json
{
  "id": "id0",
  "start_at": "start_at2",
  "end_at": "end_at0",
  "break_type_id": "break_type_id6",
  "name": "name0",
  "expected_duration": "expected_duration4",
  "is_paid": false
}
```

