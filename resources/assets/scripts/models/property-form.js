import axios from "axios";
import alertify from "alertifyjs";

export default class PropertyForm {
  constructor(data) {
    for (let field in data) {
      this[field] = data[field];
      this.hasError = false;
      this.errorMessage = "";
      this.errorCode = "";
      this.success = false;
    }
  }
  submit() {
    axios
      .post(this.url, {
        first_name: this.first_name,
        last_name: this.last_name,
        email: this.email,
        phone: this.phone,
        address: this.address,
        comments: this.comments
      })
      .then(() => {
        this.success = true;
        this.clearForm();
        alertify.success(
          "Thank you! We'll get back with you as soon as possible!"
        );
      })
      .catch(err => {
        this.hasError = true;
        this.errorMessage = err.response.data.message;
        this.errorCode = err.response.data.code;
        alertify.error(this.errorMessage);
      });
  }
  clearForm() {
    this.first_name = "";
    this.last_name = "";
    this.phone = "";
    this.address = "";
    this.email = "";
    this.comments = "";
  }
}
