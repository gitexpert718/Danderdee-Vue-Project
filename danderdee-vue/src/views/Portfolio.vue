<template>
  <div>
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
    <ContactForm id="contact" />
    <!-- end of contact section -->
  </div>
</template>

<script>
import Header from "../sections/Header";
import Freebox from "../sections/Freebox";
import Slider from "../components/Slider";
import OneSlide from "../components/OneSlide";
import ContactForm from "../sections/ContactForm";

export default {
  name: "Portfolio",
  components: {
    Header,
    Freebox,
    Slider,
    OneSlide,
    ContactForm
  }
};
</script>