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
      <div class="col-xl-6 col-lg-6">
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
            <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
            <a href="#" class="btn btn-sm btn-primary">Add Customer</a>
          </div>

          <div class="table-responsive" style="font-size: 12px">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>Qty</th>
                  <th>Unit</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="#">Name</a></td>
                  <td>Qty</td>
                  <td>Unit</td>
                  <td><span class="badge badge-success">Total</span></td>
                  <td><a href="#" class="btn btn-sm btn-primary">X</a></td>
                </tr>
                <tr>
                  <td><a href="#">Name</a></td>
                  <td>Qty</td>
                  <td>Unit</td>
                  <td><span class="badge badge-success">Total</span></td>
                  <td><a href="#" class="btn btn-sm btn-primary">X</a></td>
                </tr>
                <tr>
                  <td><a href="#">Name</a></td>
                  <td>Qty</td>
                  <td>Unit</td>
                  <td><span class="badge badge-success">Total</span></td>
                  <td><a href="#" class="btn btn-sm btn-primary">X</a></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <!-- list group starts -->
            <ul class="list-group">
              <li
                class="
                  list-group-item
                  d-flex
                  justify-content-between
                  align-items-center
                "
              >
                Total Quantity:
                <strong>56</strong>
              </li>
              <li
                class="
                  list-group-item
                  d-flex
                  justify-content-between
                  align-items-center
                "
              >
                Subtotal:
                <strong>562 $</strong>
              </li>
              <li
                class="
                  list-group-item
                  d-flex
                  justify-content-between
                  align-items-center
                "
              >
                Vat:
                <strong>5 %</strong>
              </li>
              <li
                class="
                  list-group-item
                  d-flex
                  justify-content-between
                  align-items-center
                "
              >
                Total :
                <strong>563 $</strong>
              </li>
            </ul>
            <!-- list group End  -->
            <!-- Form start -->

            <form action="" class="mt-2">
              <div class="form-group">
                <label for="customer_id">Customer</label>
                <select
                  v-model="customer_id"
                  class="form-control form-control-sm"
                  required
                >
                  <option value="">Customer 1</option>
                  <option value="">Customer 2</option>
                </select>
              </div>
              <div class="form-group">
                <label for="paid_amount">Pay</label>
                <input
                  type="text"
                  v-model="paid_amount"
                  required
                  class="form-control form-control-sm"
                />
              </div>
              <div class="form-group">
                <label for="due_amount">Due</label>
                <input
                  type="text"
                  v-model="due_amount"
                  required
                  class="form-control form-control-sm"
                />
              </div>
              <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select
                  v-model="payment_method"
                  class="form-control form-control-sm"
                  required
                >
                  <option value="HandCash">Hand Cash</option>
                  <option value="Cheaque">Cheaque</option>
                  <option value="bKash">bKash</option>
                </select>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary">
                  Submit
                </button>
              </div>
            </form>
            <!-- Form End -->
          </div>
        </div>
      </div>
      <!-- Product sold -->
      <div class="col-xl-6 col-lg-6">
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
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a
                class="nav-link active"
                id="home-tab"
                data-toggle="tab"
                href="#home"
                role="tab"
                aria-controls="home"
                aria-selected="true"
                >All Products</a
              >
            </li>
            <li
              class="nav-item"
              role="presentation"
              v-for="category in categories"
              :key="category.id"
            >
              <a
                class="nav-link"
                id="profile-tab"
                data-toggle="tab"
                href="#profile"
                role="tab"
                aria-controls="profile"
                aria-selected="false"
                @click="categoryWiseProducts(category.id)"
                >{{ category.name }}</a
              >
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div
              class="tab-pane fade show active"
              id="home"
              role="tabpanel"
              aria-labelledby="home-tab"
            >
              <div class="card-body">
                <div class="search">
                  <input
                    class="form-control"
                    type="text"
                    v-model="searchTerm"
                    placeholder="Search here"
                  />
                </div>
                <div class="row">
                  <div
                    class="col-lg-4 col-md-4 col-sm-6 col-6 mb-2"
                    v-for="product in filterSearch"
                    :key="product.id"
                  >
                    <div class="card product-card">
                      <img
                        :src="getProductPhoto() + product.image"
                        id="photo"
                        class="card-img-top"
                        v-show="product.image ? true : false"
                      />
                      <div class="card-body">
                        <h6 class="card-text text-center">
                          {{ product.name }}
                        </h6>
                        <div class="text-center pb-1">
                          <span
                            class="badge badge-info"
                            v-if="product.quantity >= 1"
                          >
                            Available
                          </span>
                          <span class="badge badge-danger" v-else>
                            Stock Out
                          </span>
                        </div>

                        <div class="text-center pt-1">
                          <button type="button" class="btn btn-primary btn-sm">
                            Add to Cart
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="tab-pane fade"
              id="profile"
              role="tabpanel"
              aria-labelledby="profile-tab"
            >
              <div class="card-body">
                <div class="search">
                  <input
                    class="form-control"
                    type="text"
                    v-model="searchTerm"
                    placeholder="Search here"
                  />
                </div>
                <div class="row">
                  <div
                    class="col-lg-4 col-md-4 col-sm-6 col-6 mb-2"
                    v-for="catProduct in catProductFilterSearch"
                    :key="catProduct.id"
                  >
                    <div class="card product-card">
                      <img
                        :src="getProductPhoto() + catProduct.image"
                        id="photo"
                        class="card-img-top"
                        v-show="catProduct.image ? true : false"
                      />
                      <div class="card-body">
                        <h6 class="card-text text-center">
                          {{ catProduct.name }}
                        </h6>
                        <div class="text-center pb-1">
                          <span
                            class="badge badge-info"
                            v-if="catProduct.quantity >= 1"
                          >
                            Available
                          </span>
                          <span class="badge badge-danger" v-else>
                            Stock Out
                          </span>
                        </div>

                        <div class="text-center pt-1">
                          <button type="button" class="btn btn-sm btn-primary">
                            Add to Cart
                          </button>
                        </div>
                      </div>
                    </div>
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
    this.getCategories();
  },
  data() {
    return {
      products: [],
      categories: [],
      catProducts: [],
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
    getCategories() {
      axios
        .get("/api/categories/")
        .then(({ data }) => (this.categories = data))
        .catch();
    },
    categoryWiseProducts(id) {
      axios
        .get("/api/category-wise/products/" + id)
        .then(({ data }) => (this.catProducts = data))
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
    catProductFilterSearch() {
      return this.catProducts.filter((product) => {
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
.search {
  width: 100%;
  margin-bottom: 8px;
}
.product-list {
  margin: 10px;
}
.product-card {
  width: 8.5rem;
  margin: 0;
}
@media (max-width: 768px) {
  .product-card {
    width: 12rem;
    margin-bottom: 15 px;
    height: 220px;
  }
  .search {
    width: 100%;
    margin-bottom: 12px;
  }
}
</style>