<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <h1 class="h3 mb-0 text-gray-800">Employee</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link to="/home">Home</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Employee</li>
        <li class="breadcrumb-item" aria-current="page">Create</li>
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
                    <h1 class="h4 text-gray-900 mb-4">Employee create from</h1>
                  </div>
                  <form @submit.prevent="register">
                    <div class="form-group">
                      <label>Full Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="exampleInputFirstName"
                        placeholder="Enter Full Name"
                        v-model="form.name"
                      />
                      <small class="text-danger" v-if="errors.name">{{
                        errors.name[0]
                      }}</small>
                    </div>
                    <!-- <div class="form-group">
                      <label>Last Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="exampleInputLastName"
                        placeholder="Enter Last Name"
                      />
                    </div> -->
                    <div class="form-group">
                      <label>Email</label>
                      <input
                        type="email"
                        class="form-control"
                        id="exampleInputEmail"
                        aria-describedby="emailHelp"
                        placeholder="Enter Email Address"
                        v-model="form.email"
                      />
                      <small class="text-danger" v-if="errors.email">{{
                        errors.email[0]
                      }}</small>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input
                        type="password"
                        class="form-control"
                        id="exampleInputPassword"
                        placeholder="Password"
                        v-model="form.password"
                      />
                      <small class="text-danger" v-if="errors.password">{{
                        errors.password[0]
                      }}</small>
                    </div>
                    <div class="form-group">
                      <label>Repeat Password</label>
                      <input
                        type="password"
                        class="form-control"
                        id="exampleInputPasswordRepeat"
                        placeholder="Repeat Password"
                        v-model="form.password_confirmation"
                      />
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">
                        Register
                      </button>
                    </div>
                  </form>
                  <hr />
                  <div class="text-center">
                    <router-link class="font-weight-bold small" to="/"
                      >Already have an account?
                    </router-link>
                  </div>
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
    return {
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
      errors: [],
    };
  },
  register() {
    // alert("done");
    axios
      .post("/api/auth/register", this.form)
      .then((res) => {
        User.responseAfterLogin(res);
        Toast.fire({
          icon: "success",
          title: "Signed in successfully",
        });
        this.$router.push({ name: "home" });
      })
      .catch((error) => (this.errors = error.response.data.errors));
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