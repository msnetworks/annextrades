<script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script>
    var sqPaymentForm = new SqPaymentForm({
      // Replace this value with your application's ID (available from the merchant dashboard).
      // If you're just testing things out, replace this with your _Sandbox_ application ID,
      // which is also available there.
      applicationId: 'sandbox-sq0idb-pERZID7zcjHjS2tpCLEsKQ',
      inputClass: 'sq-input',
      cardNumber: {
        elementId: 'sq-card-number',
        placeholder: "0000 0000 0000 0000"
      },
      cvv: {
        elementId: 'sq-cvv',
        placeholder: 'CVV'
      },
      expirationDate: {
        elementId: 'sq-expiration-date',
        placeholder: 'MM/YY'
      },
      postalCode: {
        elementId: 'sq-postal-code',
        placeholder: 'Postal Code'
      },
      // inputStyles: [
      //   // Because this object provides no value for mediaMaxWidth or mediaMinWidth,
      //   // these styles apply for screens of all sizes, unless overridden by another
      //   // input style below.
      //   {
      //     fontSize: '14px',
      //     padding: '3px'
      //   },
      //   // These styles are applied to inputs ONLY when the screen width is 400px
      //   // or smaller. Note that because it doesn't specify a value for padding,
      //   // the padding value in the previous object is preserved.
      //   {
      //     mediaMaxWidth: '400px',
      //     fontSize: '18px',
      //   }
      // ],
      callbacks: {
        cardNonceResponseReceived: function(errors, nonce, cardData) {
            if (errors) {
                var errorDiv = document.getElementById('errors');
                errorDiv.innerHTML = "";
                errors.forEach(function(error) {
                    var p = document.createElement('p');
                    p.innerHTML = error.message;
                    errorDiv.appendChild(p);
                });
            } else {
            // This alert is for debugging purposes only.
            alert('Nonce received! ' + nonce + ' ' + JSON.stringify(cardData));
            // Assign the value of the nonce to a hidden form element
            var nonceField = document.getElementById('card-nonce');
            nonceField.value = nonce;
            // Submit the form
            document.getElementById('form').submit();
        }
    },
    unsupportedBrowserDetected: function() {
          // Alert the buyer that their browser is not supported
      }
  }
});
    function submitButtonClick(event) {
        event.preventDefault();
        sqPaymentForm.requestCardNonce();
    }
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin: 30px;">
            <img src="https://annextrades.com/assets/images/logo.png" style="width: 250px;" alt="">
        </div>
        <div class="col-md-6">

            <div class="input-form" style="margin: 30px;">
                <form class="uk-form billing-form uk-flex uk-flex-wrap" id="form" novalidate action="/payment-portal/process-card.php" method="post">
                    <div class="personal-info uk-flex uk-flex-column">
                    <h4>Personal Information:</h4>
                        <div class="billing-form-group uk-flex uk-flex-space-between">
                            <input type="text" placeholder="First Name" id="given_name" class="uk-form-large form-control" style="margin-bottom: 1rem;"><br>
                            <input type="text" placeholder="Last Name" id="family_name" class="uk-form-large form-control"><br>
                        </div>
                        <input type="text" placeholder="Billing Address" class="uk-form-large form-control"><br>
                        <input type="text" placeholder="City" class="uk-form-large form-control"><br>
                        <select class="uk-form-large form-control">
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District Of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                        <br>
                        <input type="text" placeholder="Zip Code" id="sq-postal-code" class="uk-form-large form-control"><br>
                    </div>
                    <div class="card-info uk-flex uk-flex-column">
                    
                    <input name="phone" type="text" placeholder="Phone Number" class="uk-form-large form-control"><br>
                        <input name="email" type="email" placeholder="Email" class="uk-form-large form-control"><br>
                        <div class="billing-form-group uk-flex uk-flex-space-between">
                        <h4>Card Information:</h4>
                            <label for="amount">Amount * USD($)</label>
                            <input name="amount" id="amount" type="text" placeholder="Amount" value="299" class="uk-form-large form-control"break> <br>
                            <label for="ctype">Card Type</label>
                            <select id="ctype" class="uk-form-large form-control">
                                <option>Visa</option>
                                <option>Mastercard</option>
                                <option>Discover</option>
                                <option>American Express</option>
                            </select> 
                            <br>
                        </div>
                        <label for="cardno">Card Number</label>
                        <input type="text" id="cardno" placeholder="Card Number" id="sq-card-number" value="4111111111111111" class="uk-form-large form-control"><br>
                        <div class="exp-cvv-group uk-flex uk-flex-space-between">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exdate">Expiry Date</label>
                                    <input type="text" id="exdate" placeholder="MM/YY" value="0121" id="sq-expiration-date" class="uk-form-large form-control"><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="exdate">CVV</label>
                                    <input type="text" placeholder="CVV" id="sq-cvv" class="uk-form-large form-control uk-form-width-mini"><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="card-nonce" name="nonce"><br>
                    <div class="billing-button-container">
                        <input type="submit" onclick="submitButtonClick(event)" id="card-nonce-submit" class="button mid-blue-button billing-button">
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<div id="errors"></div>