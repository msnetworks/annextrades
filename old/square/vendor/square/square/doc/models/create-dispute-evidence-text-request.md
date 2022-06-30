
# Create Dispute Evidence Text Request

Defines the parameters for a `CreateDisputeEvidenceText` request.

## Structure

`CreateDisputeEvidenceTextRequest`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `idempotencyKey` | `string` |  | The Unique ID. For more information, see [Idempotency](https://developer.squareup.com/docs/working-with-apis/idempotency). | getIdempotencyKey(): string | setIdempotencyKey(string idempotencyKey): void |
| `evidenceType` | [`?string (DisputeEvidenceType)`](/doc/models/dispute-evidence-type.md) | Optional | The type of the dispute evidence. | getEvidenceType(): ?string | setEvidenceType(?string evidenceType): void |
| `evidenceText` | `string` |  | The evidence string. | getEvidenceText(): string | setEvidenceText(string evidenceText): void |

## Example (as JSON)

```json
{
  "evidence_text": "1Z8888888888888888",
  "evidence_type": "TRACKING_NUMBER",
  "idempotency_key": "ed3ee3933d946f1514d505d173c82648"
}
```

