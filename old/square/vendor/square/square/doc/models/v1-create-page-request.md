
# V1 Create Page Request

## Structure

`V1CreatePageRequest`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `body` | [`?V1Page`](/doc/models/v1-page.md) | Optional | V1Page | getBody(): ?V1Page | setBody(?V1Page body): void |

## Example (as JSON)

```json
{
  "body": {
    "id": "id6",
    "name": "name6",
    "page_index": 224,
    "cells": [
      {
        "page_id": "page_id8",
        "row": 2,
        "column": 80,
        "object_type": "ITEM",
        "object_id": "object_id6"
      }
    ]
  }
}
```

