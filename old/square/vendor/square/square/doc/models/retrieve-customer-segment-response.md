
# Retrieve Customer Segment Response

Defines the fields included in the response body for requests to __RetrieveCustomerSegment__.

One of `errors` or `segment` is present in a given response (never both).

## Structure

`RetrieveCustomerSegmentResponse`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `errors` | [`?(Error[])`](/doc/models/error.md) | Optional | Any errors that occurred during the request. | getErrors(): ?array | setErrors(?array errors): void |
| `segment` | [`?CustomerSegment`](/doc/models/customer-segment.md) | Optional | Represents a group of customer profiles that match one or more predefined filter criteria.<br><br>Segments (also known as Smart Groups) are defined and created within Customer Directory in the Square Dashboard or Point of Sale. | getSegment(): ?CustomerSegment | setSegment(?CustomerSegment segment): void |

## Example (as JSON)

```json
{
  "segment": {
    "created_at": "2020-01-09T19:33:24.469Z",
    "id": "GMNXRZVEXNQDF.CHURN_RISK",
    "name": "Lapsed",
    "updated_at": "2020-04-13T23:01:13Z"
  }
}
```

