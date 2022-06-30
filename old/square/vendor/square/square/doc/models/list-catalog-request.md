
# List Catalog Request

## Structure

`ListCatalogRequest`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `cursor` | `?string` | Optional | The pagination cursor returned in the previous response. Leave unset for an initial request.<br>See [Pagination](https://developer.squareup.com/docs/basics/api101/pagination) for more information. | getCursor(): ?string | setCursor(?string cursor): void |
| `types` | `?string` | Optional | An optional case-insensitive, comma-separated list of object types to retrieve, for example<br>`ITEM,ITEM_VARIATION,CATEGORY,IMAGE`.<br><br>The legal values are taken from the CatalogObjectType enum:<br>`ITEM`, `ITEM_VARIATION`, `CATEGORY`, `DISCOUNT`, `TAX`,<br>`MODIFIER`, `MODIFIER_LIST`, or `IMAGE`. | getTypes(): ?string | setTypes(?string types): void |
| `catalogVersion` | `?int` | Optional | The specific version of the catalog objects to be included in the response.<br>This allows you to retrieve historical<br>versions of objects. The specified version value is matched against<br>the [CatalogObject](#type-catalogobject)s' `version` attribute. | getCatalogVersion(): ?int | setCatalogVersion(?int catalogVersion): void |

## Example (as JSON)

```json
{
  "cursor": "cursor6",
  "types": "types6",
  "catalog_version": 126
}
```

