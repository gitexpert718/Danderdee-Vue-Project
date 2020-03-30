<template>
  <section>
    <div class="padding80 bgcolor3_home" id="about">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="divider50"></div>
            <div class="textbox-component">
              <h2 class="text-white">What companies offer home Wi-Fi?</h2>
              <p>
                You can get home Wi-Fi service from most major internet service providers. Many Wi-Fi providers include wireless internet service at no extra cost, but some may charge an added monthly fee. Additionally, wireless internet may require more equipment, which could result in higher initial or monthly costs. Here’s a look as some of the best home Wi-Fi providers available in the U.S.
              </p>
              <hr />
              <button type="button" class="btn btn-primary btn-md">Search</button>
            </div>
          </div>
          <div class="col-md-6">
            <div class="textbox-component">
              <div class="slider">
                <div class="slide1_one"></div>
                <div class="slide2_one"></div>
                <div class="slide3_one"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {};
</script>

<style>
.bgcolor3_home {
  background: #666699;
}
.slide1_one,
.slide2_one,
.slide3_one {
  position: absolute;
  width: 100%;
  height: 100%;
}

.slide1_one {
  background: url(../assets/img/4.jpg) no-repeat center;
  background-size: cover;
  animation: fade 8s infinite;
  -webkit-animation: fade 8s infinite;
}

.slide2_one {
  background: url(../assets/img/5.jpg) no-repeat center;
  background-size: cover;
  animation: fade2 8s infinite;
  -webkit-animation: fade2 8s infinite;
}

.slide3_one {
  background: url(../assets/img/6.jpg) no-repeat center;
  background-size: cover;
  animation: fade3 8s infinite;
  -webkit-animation: fade3 8s infinite;
}
</style>