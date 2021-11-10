<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <router-link :to="{ name: 'supplier-index' }" class="btn btn-primary">
        All Categories
      </router-link>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item" aria-current="page">
          <router-link :to="{ name: 'category-index' }">Categories</router-link>
        </li>
        <li class="breadcrumb-item" aria-current="page">Edit</li>
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
                    <h1 class="h4 text-gray-900 mb-4">Category Edit Form</h1>
                  </div>
                  <form @submit.prevent="updateCategory" class="user">
                    <div class="form-group">
                      <div class="form-row">
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
                    </div>

                    <div class="form-group mt-4">
                      <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-block">
                          Update Category
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
        name: "",
      },
      errors: [],
    };
  },
  methods: {
    updateCategory() {
      let id = this.$route.params.id;
      axios
        .patch("/api/categories/" + id, this.form)
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
    // fetching specific row
    let id = this.$route.params.id;
    if (id) {
      axios
        .get("/api/categories/" + id)
        .then(({ data }) => {
          this.form = data;
        })
        .catch(() => {
          console.log("error");
        });
    }
  },
};
</script>

<style scoped>
</style>