<template>
  <section>
    <div class="padding80 bgcolor4_home" id="about">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="textbox-component">
              <div class="slider">
                <div class="slide1_home"></div>
                <div class="slide2_home"></div>
                <div class="slide3_home"></div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="divider50"></div>
            <div class="textbox-component">
              <h2>The best wireless internet providers for home Wi-Fi</h2>
              <ul>
                <li><a href="#">AT&T</a> – Stellar customer service</li>
                <li><a href="#">CenturyLink</a> – Price-lock guarantee</li>
                <li><a href="#">Charter Spectrum</a> – Contract buyout offer</li>
                <li><a href="#">Cox</a> – Plan variety</li>
                <li><a href="#">Frontier Communications</a> – No-contract plan options</li>                
                <hr />
                <button type="button" class="btn btn-primary btn-md">Medium</button>
              </ul>
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
@keyframes fade {
  0% {
    opacity: 1;
  }
  33.333% {
    opacity: 0;
  }
  66.666% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

@keyframes fade2 {
  0% {
    opacity: 0;
  }
  33.333% {
    opacity: 1;
  }
  66.666% {
    opacity: 0;
  }
  100% {
    opacity: 0;
  }
}

@keyframes fade3 {
  0% {
    opacity: 0;
  }
  33.333% {
    opacity: 0;
  }
  66.666% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
.padding80 {
  padding: 80px;
}
.bgcolor4_home {
  background: #daffff;
}
.textbox-component {
  position: relative;
  font-family: "Ubuntu";
  font-weight: 700;
}
.textbox-component h2 {
  color: #34afe4;
}
.slider {
  width: auto;
  height: 350px;
  margin: 20px auto;
  position: relative;
}

.slide1_home,
.slide2_home,
.slide3_home {
  position: absolute;
  width: 100%;
  height: 100%;
}

.slide1_home {
  background: url(../assets/img/wifi7.jpg) no-repeat center;
  background-size: cover;
  animation: fade 8s infinite;
  -webkit-animation: fade 8s infinite;
}

.slide2_home {
  background: url(../assets/img/wifi3.jpg) no-repeat center;
  background-size: cover;
  animation: fade2 8s infinite;
  -webkit-animation: fade2 8s infinite;
}

.slide3_home {
  background: url(../assets/img/wifi4.jpg) no-repeat center;
  background-size: cover;
  animation: fade3 8s infinite;
  -webkit-animation: fade3 8s infinite;
}
.divider50 {
  height: 50px;
}
</style>