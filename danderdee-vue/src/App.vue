<template>
  <div id="app">
    <!-- navbar -->
    <Navbar />
    <!-- end of navbar -->
    <router-view></router-view>
    <!-- footer section -->
    <Footer />
    <!-- end of footer section -->
  </div>
</template>

<script>
import Navbar from "./components/Navbar";
import Footer from "./sections/Footer";

export default {
  name: "app",
  components: {
    Navbar,
    Footer
  }
};
</script>

<style>
body,
html {
  width: 100%;
  height: 100%;
}

body,
h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: "Ubuntu", "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-weight: 700;
}
</style>
