<template>
  <div class="page404">
    <b-jumbotron
      header="Oops!"
      lead="Page Not Found!"
      text-variant="white"
      bg-variant="danger"
      class="text-center"
    >
      <b-button variant="warning" href="/">Home</b-button>
    </b-jumbotron>
  </div>
</template>

<script>
export default {
  name: "NotFound"
};
</script>

<style>
.page404 {
  margin-top: 100px;
  margin-bottom: 100px;
}
</style>