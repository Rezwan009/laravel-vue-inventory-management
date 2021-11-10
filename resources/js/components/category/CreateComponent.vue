<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <router-link :to="{ name: 'category-index' }" class="btn btn-primary">
        All Category
      </router-link>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item" aria-current="page">
          <router-link :to="{ name: 'category-index' }">Categories</router-link>
        </li>
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
                    <h1 class="h4 text-gray-900 mb-4">Category Create Form</h1>
                  </div>
                  <form @submit.prevent="storeCategory" class="user">
                    <div class="form-group">
                      <div class="col-md-8">
                        <label>Category Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="Enter Category Name"
                          v-model="form.name"
                        />
                        <small class="text-danger" v-if="errors.name">{{
                          errors.name[0]
                        }}</small>
                      </div>
                    </div>

                    <div class="form-group mt-4">
                      <div class="col-md-8">
                        <button type="submit" class="btn btn-primary btn-block">
                          Add Category
                        </button>
                      </div>
                    </div>
                  </form>

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
      },
      errors: [],
    };
  },
  methods: {
    storeCategory() {
      axios
        .post("/api/categories", this.form)
        .then(() => {
          this.$router.push({ name: "category-index" });
          Notification.success();
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
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