<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <router-link to="/employee/create" class="btn btn-primary">
        Add Employee
      </router-link>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link to="/home">Home</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <router-link to="/employees">Employees</router-link>
        </li>
        <li class="breadcrumb-item" aria-current="page">Data</li>
      </ol>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-2">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">All employees</h1>
                  </div>
                  <!-- Table goes here -->

                  <div class="text-center"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {};
  },
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "login" });
    }
  },
};
</script>

<style scoped>
</style>