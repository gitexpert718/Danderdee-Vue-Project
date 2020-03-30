<template>
  <section id="home">
    <div class="intro-header-home">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="intro-message-home">
              <svg
                width="25%"
                height="25%"
                id="danderdee-symbol"
                viewBox="0 0 133 106"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"
              >
                <g
                  fill="#f8f8f8"
                  fill-opacity="0.6"
                  id="band3b"
                  transform="matrix(1,0,0,1,-430.22,-288.216)"
                >
                  <path
                    d="M450.02,301.12C467.58,290.61 488.77,286.21 509.06,289.07C529.44,291.88 549.11,301.61 562.88,317.01C560,320.03 557.03,323.03 553.77,325.62C551.62,325.19 550.28,322.78 548.56,321.47C523.6,297.57 481.84,294.82 453.67,314.65C448.76,317.92 444.51,322.03 440.01,325.81C436.55,323.11 433.53,319.89 430.22,317.02C436.16,310.97 442.89,305.69 450.02,301.12Z"
                  />
                </g>
                <g
                  fill="#f8f8f8"
                  fill-opacity="0.6"
                  id="band2b"
                  transform="matrix(1,0,0,1,-430.22,-288.216)"
                >
                  <path
                    d="M448.94,335.07C459.9,322.96 475.6,315.25 491.93,314.25C511.61,312.47 531.56,320.73 544.82,335.26C541.69,338.27 538.8,341.64 535.07,343.93C527.64,337.02 519.06,330.89 508.95,328.73C491,324.19 470.9,330.3 458.68,344.25C455.31,341.34 451.41,338.84 448.94,335.07Z"
                  />
                </g>
                <g
                  fill="#f8f8f8"
                  fill-opacity="0.6"
                  id="band1b"
                  transform="matrix(1,0,0,1,-430.22,-288.216)"
                >
                  <path
                    d="M466.83,353.97C473.23,346.15 482.76,341.05 492.83,340.16C505.58,338.61 518.55,344.26 526.86,353.9C523.43,356.67 520.07,359.54 516.81,362.51C510.61,355.69 501.11,352.11 491.97,353.96C486.08,354.65 481.31,358.36 476.9,362.01C473.15,359.86 470.18,356.64 466.83,353.97Z"
                  />
                </g>
                <g fill="#f8f8f8" id="band0b" transform="matrix(1,0,0,1,-430.22,-288.216)">
                  <path
                    d="M492.33,364.43C501.23,361.22 511.75,368.56 511.76,378.01C512.46,386.18 505.28,394.13 496.98,393.78C490.6,394.21 484.67,389.65 482.46,383.83C479.74,376.13 484.21,366.49 492.33,364.43Z"
                    style="fill:rgb(247,150,38);fill-rule:nonzero;"
                  />
                </g>
              </svg>
              <div class="typewrite-home">
                <vue-typer
                  :text="['Welcome to visit our Homepage.', 'The portable Wi-Fi device.']"
                  :erase-delay="100"
                  erase-style="backspace"
                  caret-animation="blink"
                ></vue-typer>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "Header_home"
};
</script>

<style>
.intro-header-home {
  padding-top: 50px;
  /* If you're making other pages, make sure there is 50px of padding to make sure the navbar doesn't overlap content! */
  padding-bottom: 50px;
  text-align: center;
  background: url(../assets/img/10.jpg) no-repeat center center;
  background-size: cover;
}
.intro-message-home {
  position: relative;
  padding-top: 20%;
  padding-bottom: 20%;
}
.intro-message-home > h1 {
  margin: 0;
  text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.6);
  font-size: 4.75em;
  color: white;
}
.intro-message-home > h3 {
  text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.6);
}
.typewrite-home {
  margin-top: 50px;
  text-align: center;
  min-height: 100px;
}
.vue-typer .custom.char.typed {
  color: white;
  font-size: 52px;
  font-weight: 700;
  font-family: "Ubuntu", "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.vue-typer .custom.caret {
  width: 5px;
  background-color: white;
}
@media (max-width: 767px) {
  .intro-message-home {
    padding-bottom: 15%;
  }
  .intro-message-home > h1 {
    font-size: 3em;
  }
}
</style>