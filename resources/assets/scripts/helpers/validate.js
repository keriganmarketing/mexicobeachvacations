export default class Validator {
  constructor(info) {
    for (let field in info) {
      this[field] = info[field];
    }
    this.errorMessages = [];
  }

  passes() {
    if (this.Address === "") {
      this.errorMessages.push("The Address field in Step 2 is required");
    }
    if (this.ArrivalDate === "") {
      this.errorMessages.push("The Check In field in Step 1 is required");
    }
    if (this.BillingAddress === "") {
      this.errorMessages.push(
        "The Billing Address field in Step 3 is required"
      );
    }
    if (this.BillingCity === "") {
      this.errorMessages.push("The Billing City field in Step 3 is required");
    }
    if (this.BillingCountry === "") {
      this.errorMessages.push(
        "The Billing Country field in Step 3 is required"
      );
    }
    if (this.BillingState === "") {
      this.errorMessages.push("The BillingState field in Step 3 is required");
    }
    if (this.BillingZip === "") {
      this.errorMessages.push("The Billing Zip field in Step 3 is required");
    }
    if (this.CCCVCode === "") {
      this.errorMessages.push("The CCCV field in Step 3 is required");
    }
    if (this.City === "") {
      this.errorMessages.push("The City field in Step 2 is required");
    }
    if (this.Country === "") {
      this.errorMessages.push("The Country field in Step 2 is required");
    }
    if (this.CreditCardNumber === "") {
      this.errorMessages.push("The Credit Card field in Step 3 is required");
    }
    if (this.DepartureDate === "") {
      this.errorMessages.push("The Checkout Date field in Step 1 is required");
    }
    if (this.Email === "") {
      this.errorMessages.push("The Email field in Step 2 is required");
    }
    if (this.ExpMonth === 0) {
      this.errorMessages.push(
        "The Expiration Month field in Step 3 is required"
      );
    }
    if (this.ExpYear === 0) {
      this.errorMessages.push(
        "The Expiration Year field in Step 3 is required"
      );
    }
    if (this.FirstName === "") {
      this.errorMessages.push("The First name field in Step 2 is required");
    }
    if (this.LastName === "") {
      this.errorMessages.push("The Last Name field in Step 2 is required");
    }
    if (this.NameOnCard === "") {
      this.errorMessages.push(
        "You must provide a valid name for the credit card on Step 3"
      );
    }
    if (this.Persons === "") {
      this.errorMessages.push(
        "You must specify the number of persons in Step 1"
      );
    }
    if (this.State === "") {
      this.errorMessages.push("The State field in Step 2 is required");
    }
    if (this.Zip === "") {
      this.errorMessages.push("The Zip field in Step 2 is required");
    }

    return this.errorMessages.length === 0;
  }
}
