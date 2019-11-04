<template>
  <div id="app">
    <!-- navbar -->
    <Navbar />
    <!-- end of navbar -->

    <!-- header section -->
    <Header />
    <!-- end of header section -->

    <!-- free wifi section -->
    <Freebox />
    <!-- end of free wifi section -->

    <!-- slider section -->
    <Slider />
    <!-- end of slider section -->

    <!-- One slider section -->
    <OneSlide />
    <!-- end of one slider section -->

    <!-- contact section -->
    <ContactForm />
    <!-- end of contact section -->

    <!-- footer section -->
    <Footer />
    <!-- end of footer section -->
  </div>
</template>

<script>
import Navbar from "./components/Navbar";
import Header from "./sections/Header";
import Freebox from "./sections/Freebox";
import Slider from "./components/Slider";
import OneSlide from "./components/OneSlide";
import ContactForm from "./sections/ContactForm";
import Footer from "./sections/Footer";

export default {
  name: "app",
  components: {
    Navbar,
    Header,
    Freebox,
    Slider,
    OneSlide,
    ContactForm,
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
