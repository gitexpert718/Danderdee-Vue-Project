<template>
  <section>
    <div class="padding80 bgcolor4" id="about">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="textbox-component">
              <div class="slider">
                <div class="slide1"></div>
                <div class="slide2"></div>
                <div class="slide3"></div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="divider50"></div>
            <div class="textbox-component">
              <h2>Do More.</h2>
              <ul>
                <li>Public Wi-Fi is broken. We are here to make bad Public Wi-Fi a thing of the past.</li>
                <hr />
                <button type="button" class="btn btn-warning btn-md">Medium</button>
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
.bgcolor4 {
  background: #daffa0;
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

.slide1,
.slide2,
.slide3 {
  position: absolute;
  width: 100%;
  height: 100%;
}

.slide1 {
  background: url(../assets/img/dddbox.jpg) no-repeat center;
  background-size: cover;
  animation: fade 8s infinite;
  -webkit-animation: fade 8s infinite;
}

.slide2 {
  background: url(../assets/img/dddbox2.jpg) no-repeat center;
  background-size: cover;
  animation: fade2 8s infinite;
  -webkit-animation: fade2 8s infinite;
}

.slide3 {
  background: url(../assets/img/dddbox3.jpg) no-repeat center;
  background-size: cover;
  animation: fade3 8s infinite;
  -webkit-animation: fade3 8s infinite;
}
.divider50 {
  height: 50px;
}
</style>