<template></template>

<script>
import AppStorage from "../../helpers/AppStorage";
export default {
  created() {
    AppStorage.clearStorage();
    Toast.fire({
      icon: "success",
      title: "Signed out successfully",
    });
    this.$router.push({ name: "login" });
  },
};
</script>

<style scoped>
</style>