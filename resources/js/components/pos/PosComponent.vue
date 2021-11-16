<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Point Of Sale</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">POS</li>
      </ol>
    </div>

    <div class="row mb-3">
      <!-- Area Chart -->
      <div class="col-xl-5 col-lg-5">
        <div class="card mb-4">
          <div
            class="
              card-header
              py-3
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h6 class="m-0 font-weight-bold text-primary">
              Monthly Recap Report
            </h6>
          </div>
          <div class="card-body">
            <div class="chart-area">Content Goes header</div>
          </div>
        </div>
      </div>
      <!-- Product sold -->
      <div class="col-xl-7 col-lg-7">
        <div class="card mb-4">
          <div
            class="
              card-header
              py-3
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
          </div>
          <div class="card-body">
            <div class="row ml-0">
              <div
                class="col-lg-3 col-md-3 col-sm-6 col-6 ml-4 mb-4"
                v-for="product in filterSearch"
                :key="product.id"
              >
                <div class="card" style="width: 8.9rem">
                  <img
                    :src="getProductPhoto() + product.image"
                    id="photo"
                    class="card-img-top"
                    v-show="product.image ? true : false"
                  />
                  <div class="card-body">
                    <h6 class="card-text">{{ product.name }}</h6>
                    <span class="badge badge-info" v-if="product.quantity >= 1">
                      Available
                    </span>
                    <span class="badge badge-danger" v-else> Stock Out </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Row-->
  </div>
</template>

<script>
export default {
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "login" });
    }
    this.getProducts();
  },
  data() {
    return {
      products: [],
      searchTerm: "",
    };
  },
  methods: {
    getProducts() {
      axios
        .get("/api/products")
        .then(({ data }) => (this.products = data))
        .catch();
    },
    getProductPhoto() {
      return "/backend/assets/img/product/";
    },
  },
  computed: {
    filterSearch() {
      return this.products.filter((product) => {
        return product.name.match(this.searchTerm);
      });
    },
  },
};
</script>

<style scoped>
#photo {
  width: 130;
  height: 100px;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
#search {
  width: 400px;
}
</style>