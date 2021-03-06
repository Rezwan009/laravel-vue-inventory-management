<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <router-link :to="{ name: 'product-create' }" class="btn btn-primary">
        Add Product
      </router-link>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <router-link :to="{ name: 'product-index' }">Products</router-link>
        </li>
        <li class="breadcrumb-item" aria-current="page">Data</li>
      </ol>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-2">
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
            <h6 class="m-0 font-weight-bold text-primary">Product list</h6>
            <input
              class="form-control"
              type="text"
              v-model="searchTerm"
              id="search"
              placeholder="Search here"
            />
          </div>

          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <!-- Table goes here -->
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Product Name</th>
                        <th>Photo</th>
                        <th>Selling Price</th>
                        <th>Quantity</th>
                        <th>Product Category</th>
                        <th>Product Supplier</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in filterSearch" :key="product.id">
                        <td>
                          <a href="#">{{ product.name }}</a>
                        </td>
                        <td>
                          <img
                            :src="getProductPhoto() + product.image"
                            id="photo"
                            v-show="product.image ? true : false"
                          />
                        </td>
                        <td>{{ product.selling_price }}</td>
                        <td>{{ product.quantity }}</td>
                        <td>
                          <span class="badge badge-success">
                            {{ product.category_name }}
                          </span>
                        </td>
                        <td>
                          <span class="badge badge-info">
                            {{ product.supplier_name }}
                          </span>
                        </td>
                        <td>
                          <router-link
                            :to="{
                              name: 'product-edit',
                              params: { id: product.id },
                            }"
                            class="btn btn-sm btn-primary"
                            >Edit</router-link
                          >
                          <a
                            @click="deleteRecord(product.id)"
                            class="btn btn-sm btn-danger text-white"
                            >Delete</a
                          >
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
      return "backend/assets/img/product/";
    },
    deleteRecord(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete("/api/products/" + id)
            .then(() => {
              this.products = this.products.filter((product) => {
                return product.id != id;
              });
            })
            .catch(() => {});
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
      });
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
  width: 40;
  height: 30px;
}
#search {
  width: 400px;
}
</style>