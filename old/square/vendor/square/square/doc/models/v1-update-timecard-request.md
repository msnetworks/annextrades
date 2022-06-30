
# V1 Update Timecard Request

## Structure

`V1UpdateTimecardRequest`

## Fields

| Name | Type | Description | Getter | Setter |
|  --- | --- | --- | --- | --- |
| `body` | [`V1Timecard`](/doc/models/v1-timecard.md) | Represents a timecard for an employee. | getBody(): V1Timecard | setBody(V1Timecard body): void |

## Example (as JSON)

```json
{
  "body": {
    "id": "id6",
    "employee_id": "employee_id4",
    "deleted": false,
    "clockin_time": "clockin_time2",
    "clockout_time": "clockout_time2",
    "clockin_location_id": "clockin_location_id4"
  }
}
```

