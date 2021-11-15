<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <router-link :to="{ name: 'product-stock' }" class="btn btn-primary">
        Product Stock
      </router-link>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item" aria-current="page">
          <router-link :to="{ name: 'product-stock' }"
            >ProductStock
          </router-link>
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
                    <h1 class="h4 text-gray-900 mb-4">Product Edit Form</h1>
                  </div>
                  <form @submit.prevent="updateStock" class="user">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-12">
                          <label>Product Quantity</label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            v-model="form.quantity"
                          />
                          <small class="text-danger" v-if="errors.quantity">{{
                            errors.quantity[0]
                          }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="form-group mt-4">
                      <button type="submit" class="btn btn-primary btn-block">
                        Update Product
                      </button>
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
        quantity: "",
      },
      errors: {},
    };
  },
  methods: {
    updateStock() {
      let id = this.$route.params.id;
      axios
        .post("/api/stock/update/" + id, this.form)
        .then(() => {
          this.$router.push({ name: "product-stock" });
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
        .get("/api/products/" + id)
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