<template>
  <section>
    <div class="container-fluid text-center">
      <h2 class="mt-4">
        <a href="#contact">Want a free WiFi Box?</a>
      </h2>

      <div class="container-fluid">
        <div class="row smallblock">
          <div class="col-xs-12 col-sm-6 col-md-3 smallblock">
            <div class="contentb p-green">
              <span style="font-size:2em" class="glyphicon-leaf">
                <font-awesome-icon icon="leaf" />
                <br />About
              </span>
              <div class="text hfix">Learn more about Danderdee.</div>
              <br />
              <a class="btn btn-success btn-outline btn-lg" href="#about">About</a>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 smallblock">
            <div class="content p-yel">
              <span style="font-size:2em" class="glyphicon-globe">
                <font-awesome-icon icon="globe-americas" />
                <br />Portfolio
              </span>
              <div class="text hfix">Value via customer metrics and increased sales.</div>
              <br />
              <a class="btn btn-warning btn-outline btn-lg" href="portfolio">Portfolio</a>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 smallblock">
            <div class="content p-red">
              <span style="font-size:2em" class="glyphicon-stats">
                <font-awesome-icon icon="chart-bar" />
                <br />Advertisers
              </span>
              <div class="text hfix">Want to learn about our exciting new platform?</div>
              <br />
              <a class="btn btn-primary btn-outline btn-lg" href="#contact">Connect</a>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 smallblock">
            <div class="content p-blue">
              <span style="font-size:2em" class="glyphicon-briefcase">
                <font-awesome-icon icon="briefcase" />
                <br />Investors
              </span>
              <div class="text hfix">Reach out to us and start a dialogue.</div>
              <br />
              <a class="btn btn-danger btn-outline btn-lg" href="#contact">Connect</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style>
.hfix {
  height: 30px;
}

.minh {
  min-height: 70px;
  min-width: 70px;
}
.content {
  text-align: center;
  font-size: 14px;
  margin-top: 30px;
  margin-left: 3px;
  margin-right: 3px;
  padding-left: 0;
  margin-bottom: 30px;
  font-family: "raleway";
  padding: 13px;
}

.content li:first-child,
.content li:last-child {
  padding: 20px 20px 0px 13px;
}

.content li {
  list-style: none;
  padding-top: 7px;
  padding-bottom: 7px;
}

.content big {
  font-size: 36px;
}
.contentb {
  text-align: center;
  font-size: 14px;
  padding-left: 0;
  margin-left: 3px;
  margin-right: 3px;
  margin-top: 30px;
  margin-bottom: 30px;
  font-family: "raleway";
  padding: 13px;
}

.contentb li:first-child,
.contentb li:last-child {
  padding: 20px 20px 0px 13px;
}

.contentb li {
  list-style: none;
  padding-top: 7px;
  padding-bottom: 7px;
}

.contentb big {
  font-size: 36px;
}
.p-green big,
.p-green h3 {
  color: #5cb85c;
}

/* Button Color Green*/
.p-green button {
  background: #5cb85c;
}

/* Button Color Yellow */
.p-yel button {
  background: #f0ad4e;
}

/* Title Color Yellow */
.p-yel big,
.p-yel h3 {
  color: #f0ad4e;
}

/* Button Color blue */
.p-red button {
  background: #428bca;
}

/* Title Color blue */
.p-red big,
.p-red h3 {
  color: #428bca;
}

/* Button Color Red */
.p-blue button {
  background: #d9534f;
}

/* Title Color Red */
.p-blue big,
.p-blue h3 {
  color: #d9534f;
}

/* Glyphicon Green */
span.glyphicon-leaf {
  font-size: 2.9em;
  color: #5cb85c;
  display: block;
  margin: auto;
  margin-bottom: 7px;
}

/* Glyphicon Yellow */
span.glyphicon-globe {
  font-size: 2.9em;
  color: #f0ad4e;
  display: block;
  margin: auto;
  margin-bottom: 7px;
}

/* Glyphicon blue */
span.glyphicon-stats {
  font-size: 2.9em;
  color: #428bca;
  display: block;
  margin: auto;
  margin-bottom: 7px;
}

/* Glyphicon Red */
span.glyphicon-briefcase {
  font-size: 2.9em;
  color: #d9534f;
  display: block;
  margin: auto;
  margin-bottom: 7px;
}

.btn-outline {
  color: inherit;
  transition: all 0.5s;
  background-color: transparent;
}

.btn-primary.btn-outline {
  color: #428bca;
  background-color: transparent;
}

.btn-success.btn-outline {
  color: #5cb85c;
  background-color: transparent;
}

.btn-info.btn-outline {
  color: #5bc0de;
  background-color: transparent;
}

.btn-warning.btn-outline {
  color: #f0ad4e;
  background-color: transparent;
}

.btn-danger.btn-outline {
  color: #d9534f;
  background-color: transparent;
}

.btn-primary.btn-outline:hover,
.btn-success.btn-outline:hover,
.btn-info.btn-outline:hover,
.btn-warning.btn-outline:hover,
.btn-danger.btn-outline:hover {
  color: #fff;
}

.btn-outline.btn-lg {
  background-color: transparent;
  padding-left: 50px;
  padding-right: 50px;
}
.text {
  color: #000;
  font-family: "Lato", sans-serif;
  font-weight: 500;
  font-size: 15px;
}
</style>