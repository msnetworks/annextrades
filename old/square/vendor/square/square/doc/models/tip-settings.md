
# Tip Settings

## Structure

`TipSettings`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `allowTipping` | `?bool` | Optional | Indicates whether tipping is enabled for this checkout. Defaults to false. | getAllowTipping(): ?bool | setAllowTipping(?bool allowTipping): void |
| `separateTipScreen` | `?bool` | Optional | Indicates whether tip options should be presented on their own screen before presenting<br>the signature screen during card payment. Defaults to false. | getSeparateTipScreen(): ?bool | setSeparateTipScreen(?bool separateTipScreen): void |
| `customTipField` | `?bool` | Optional | Indicates whether custom tip amounts are allowed during the checkout flow. Defaults to false. | getCustomTipField(): ?bool | setCustomTipField(?bool customTipField): void |
| `tipPercentages` | `?(int[])` | Optional | A list of tip percentages that should be presented during the checkout flow. Specified as<br>up to 3 non-negative integers from 0 to 100 (inclusive). Defaults to [15, 20, 25] | getTipPercentages(): ?array | setTipPercentages(?array tipPercentages): void |
| `smartTipping` | `?bool` | Optional | Enables the "Smart Tip Amounts" behavior described in https://squareup.com/help/us/en/article/5069-accept-tips-with-the-square-app.<br>Exact tipping options depend on the region the Square seller is active in.<br><br>In the United States and Canada, tipping options will be presented in whole dollar amounts for<br>payments under 10 USD/CAD respectively.<br><br>If set to true, the tip_percentages settings is ignored.<br>Defaults to false. | getSmartTipping(): ?bool | setSmartTipping(?bool smartTipping): void |

## Example (as JSON)

```json
{
  "allow_tipping": false,
  "separate_tip_screen": false,
  "custom_tip_field": false,
  "tip_percentages": [
    156,
    157
  ],
  "smart_tipping": false
}
```

