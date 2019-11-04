<template>
  <footer class="pt-5 pb-2">
    <div class="container">
      <!-- Gives more room -->
      <div class="row">
        <div class="col-lg-12">
          <!-- This is the code you will get from Mailchimp’s NAKED Signup Form -->
          <div class="mc_embed_signup text-center mb-3">
            <form
              action="//danderdee.us15.list-manage.com/subscribe/post?u=0daada696e566ee5075b3feed&amp;id=1d82370ba3"
              class="validate"
              id="mc-embedded-subscribe-form"
              method="post"
              name="mc-embedded-subscribe-form"
              novalidate
              target="_blank"
            >
              <div id="mc_embed_signup_scroll">
                <!-- Text Input Field -->
                <div class="mc-field-group">
                  Subscribe to our mailing list:
                  <input
                    class="required email ml-2 mr-2"
                    id="mce-EMAIL"
                    name="email"
                    placeholder="Your Email"
                    type="email"
                  />
                </div>
                <!-- /Text Input Field -->
                <div class="clear" id="mce-responses">
                  <div class="response" id="mce-error-response" style="display:none"></div>
                  <div class="response" id="mce-success-response" style="display:none"></div>
                </div>
                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;">
                  <input
                    name="b_0daada696e566ee5075b3feed_1d82370ba3"
                    tabindex="-1"
                    type="text"
                    value
                  />
                </div>
                <!-- Submit Button -->
                <div class="clear">
                  <input
                    class="button-subscribe"
                    id="mc-embedded-subscribe"
                    name="subscribe"
                    type="submit"
                    value="Subscribe"
                  />
                </div>
                <!-- /Submit Button -->
              </div>
            </form>
          </div>
          <!-- button 2-->
          <p class="copyright text-muted small text-center">Copyright &copy; Danderdee Limited 2017.</p>
          <!--End mc_embed_signup-->
          <ul class="pull-left list-inline">
            <li>
              <a href="index.html">Home</a>
            </li>
            <li>&sdot;</li>
            <li>
              <a href="#about">About</a>
            </li>
            <li>&sdot;</li>
            <li>
              <a href="terms.html">Terms & Conditions</a>
            </li>
            <li>&sdot;</li>
            <li>
              <a href="privacy.html">Privacy Policy</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {};
</script>

<style>
footer {
  font-family: "Ubuntu";
}
.mc_embed_signup {
  border: none;
  text-align: center;
  width: 100%;
}
.mc-field-group {
  display: inline-block;
}
#mce-EMAIL {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 1em;
  border: 2px solid #abb0b2;
  color: #343434;
  background-color: #fff;
  padding: 0.7em 9em 0.7em 1em;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  display: inline-block;
  margin: 0;
}
.clear {
  display: inline-block;
}
.button-subscribe {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 1em;
  letter-spacing: 0.03em;
  color: #fff;
  background-color: #2386c8;
  padding: 0.7em 2em;
  border: 2px solid #2386c8;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  display: inline-block;
  margin: 0;
}
.list-inline {
  padding: 10px 0;
}
.list-inline li {
  display: inline;
  margin-right: 10px;
}
p.copyright {
  margin: 15px 0 0;
}
@media (max-width: 768px) {
  /* positions input field and button underneath each other with 100% width for tablet and mobile */
  .mc-field-group {
    display: block;
    max-width: 100%;
  }
  #mce-EMAIL {
    padding: 0.7em 0 0.7em 1em;
    width: 96%;
    margin: 0;
  }
  .clear {
    display: block;
    width: 100%;
  }
  .button {
    width: 100%;
    margin: 0.5em 0 0 0;
  }
}
@media only screen and (min-width: 490px),
  only screen and (min-device-width: 490px) {
  p.copyright {
    float: right;
  }
}
@media only screen and (max-width: 480px),
  only screen and (max-device-width: 480px) {
  p.copyright {
    text-align: center;
  }
}
</style>