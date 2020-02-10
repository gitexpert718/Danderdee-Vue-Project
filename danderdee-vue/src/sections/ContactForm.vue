<template>
  <div class="contact-form bgcolor2 whitetext pt-5 pb-5">
    <div class="text-center">
      <h1>Want a free Wi-Fi box?</h1>
      <h2>Our business Wi-Fi service will be launching soon.</h2>
      <h3>Enter your details to apply for the beta:</h3>
      <br />
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="well well-sm">
            <form method="post" @submit.prevent="onSubmit">
              <div class="form-group row">
                <label for="f_name" class="col-sm-2 col-form-label text-right">
                  <font-awesome-icon icon="user" class="bigicon" />
                </label>
                <div class="col-sm-10">
                  <input
                    id="f_name"
                    v-model="formData.f_name"
                    name="f_name"
                    data-error="Please fill out this field."
                    required="true"
                    type="text"
                    placeholder="First Name"
                    class="form-control"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label for="l_name" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <input
                    id="l_name"
                    v-model="formData.s_name"
                    name="l_name"
                    type="text"
                    placeholder="Last Name"
                    class="form-control"
                    data-error="Please fill out this field."
                  />
                </div>
              </div>
              <div class="form-group row">
                <label for="b_name" class="col-sm-2 col-form-label text-right text-right">
                  <font-awesome-icon icon="building" class="bigicon" />
                </label>
                <div class="col-sm-10">
                  <input
                    id="b_name"
                    v-model="formData.b_name"
                    name="b_name"
                    type="text"
                    placeholder="Business Name"
                    class="form-control"
                    data-error="Please fill out this field."
                  />
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label text-right text-right">
                  <font-awesome-icon icon="envelope" class="bigicon" />
                </label>
                <div class="col-sm-10">
                  <input
                    id="email"
                    v-model="formData.email"
                    name="email"
                    type="text"
                    placeholder="Email Address"
                    class="form-control"
                    data-error="Please fill out this field."
                  />
                </div>
              </div>
              <div class="form-group row">
                <label for="p_code" class="col-sm-2 col-form-label text-right">
                  <font-awesome-icon icon="map-marker-alt" class="bigicon" />
                </label>
                <div class="col-sm-10">
                  <input
                    id="p_code"
                    v-model="formData.postcode"
                    name="p_code"
                    type="text"
                    placeholder="Postcode"
                    class="form-control"
                    data-error="Please fill out this field."
                  />
                </div>
              </div>
              <div class="form-group row">
                <label for="select_country" class="col-sm-2 col-form-label text-right">
                  <font-awesome-icon icon="globe-americas" class="bigicon" />
                </label>
                <div class="col-sm-10">
                  <!-- select country here -->
                  <SelectCountry id="select_country" v-on:selectCountry="selectCountryInParent" />
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                  <button type="submit" class="btn btn-info" @click="onSubmit">Sign in</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SelectCountry from "../components/SelectCountry";

export default {
  components: {
    SelectCountry
  },
  data() {
    return {
      isSuccess: false,
      message: "",
      formData: {
        f_name: "",
        s_name: "",
        b_name: "",
        email: "",
        b_country: "",
        postcode: ""
      }
    };
  },
  methods: {
    onSubmit() {
      const postUrl = "https://danderdee.com/Save";

      this.$http
        .post(postUrl, this.formData)
        .then(result => {
          this.isSuccess = true;
          this.message = result;
        })
        .catch(error => {
          this.isSuccess = false;
          this.message = error;
        });
    },
    selectCountryInParent(value) {
      this.formData.b_country = value;
    }
  }
};
</script>

<style>
.bgcolor2 {
  background: #000000;
}
.whitetext p,
h1,
h3 {
  color: white;
}
.whitetext h2 {
  color: #36a0ff;
}
.well {
  background-color: white;
  padding: 30px;
}
.bigicon {
  font-size: 32px !important;
  color: #36a0ff;
}
</style>