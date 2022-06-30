
# Customer Filter

Represents a set of `CustomerQuery` filters used to limit the set of
`Customers` returned by `SearchCustomers`.

## Structure

`CustomerFilter`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `creationSource` | [`?CustomerCreationSourceFilter`](/doc/models/customer-creation-source-filter.md) | Optional | Creation source filter.<br><br>If one or more creation sources are set, customer profiles are included in,<br>or excluded from, the result if they match at least one of the filter<br>criteria. | getCreationSource(): ?CustomerCreationSourceFilter | setCreationSource(?CustomerCreationSourceFilter creationSource): void |
| `createdAt` | [`?TimeRange`](/doc/models/time-range.md) | Optional | Represents a generic time range. The start and end values are<br>represented in RFC 3339 format. Time ranges are customized to be<br>inclusive or exclusive based on the needs of a particular endpoint.<br>Refer to the relevant endpoint-specific documentation to determine<br>how time ranges are handled. | getCreatedAt(): ?TimeRange | setCreatedAt(?TimeRange createdAt): void |
| `updatedAt` | [`?TimeRange`](/doc/models/time-range.md) | Optional | Represents a generic time range. The start and end values are<br>represented in RFC 3339 format. Time ranges are customized to be<br>inclusive or exclusive based on the needs of a particular endpoint.<br>Refer to the relevant endpoint-specific documentation to determine<br>how time ranges are handled. | getUpdatedAt(): ?TimeRange | setUpdatedAt(?TimeRange updatedAt): void |
| `emailAddress` | [`?CustomerTextFilter`](/doc/models/customer-text-filter.md) | Optional | A filter to select customers based on exact or fuzzy matching of<br>customer attributes against a specified query. Depending on customer attributes,<br>the filter can be case sensitive. This filter can be either exact or fuzzy. It cannot be both. | getEmailAddress(): ?CustomerTextFilter | setEmailAddress(?CustomerTextFilter emailAddress): void |
| `phoneNumber` | [`?CustomerTextFilter`](/doc/models/customer-text-filter.md) | Optional | A filter to select customers based on exact or fuzzy matching of<br>customer attributes against a specified query. Depending on customer attributes,<br>the filter can be case sensitive. This filter can be either exact or fuzzy. It cannot be both. | getPhoneNumber(): ?CustomerTextFilter | setPhoneNumber(?CustomerTextFilter phoneNumber): void |
| `referenceId` | [`?CustomerTextFilter`](/doc/models/customer-text-filter.md) | Optional | A filter to select customers based on exact or fuzzy matching of<br>customer attributes against a specified query. Depending on customer attributes,<br>the filter can be case sensitive. This filter can be either exact or fuzzy. It cannot be both. | getReferenceId(): ?CustomerTextFilter | setReferenceId(?CustomerTextFilter referenceId): void |
| `groupIds` | [`?FilterValue`](/doc/models/filter-value.md) | Optional | A filter to select resources based on an exact field value. For any given<br>value, the value can only be in one property. Depending on the field, either<br>all properties can be set or only a subset will be available.<br><br>Refer to the documentation of the field. | getGroupIds(): ?FilterValue | setGroupIds(?FilterValue groupIds): void |

## Example (as JSON)

```json
{
  "creation_source": {
    "values": [
      "THIRD_PARTY_IMPORT",
      "THIRD_PARTY",
      "TERMINAL"
    ],
    "rule": "INCLUDE"
  },
  "created_at": {
    "start_at": "start_at4",
    "end_at": "end_at8"
  },
  "updated_at": {
    "start_at": "start_at6",
    "end_at": "end_at6"
  },
  "email_address": {
    "exact": "exact2",
    "fuzzy": "fuzzy8"
  },
  "phone_number": {
    "exact": "exact2",
    "fuzzy": "fuzzy8"
  }
}
```

