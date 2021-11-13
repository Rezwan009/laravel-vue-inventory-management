<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <router-link :to="{ name: 'product-index' }" class="btn btn-primary">
        All Products
      </router-link>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item" aria-current="page">
          <router-link :to="{ name: 'product-index' }">Products</router-link>
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
                    <h1 class="h4 text-gray-900 mb-4">Product Create Form</h1>
                  </div>
                  <form
                    @submit.prevent="storeProduct"
                    class="user"
                    enctype="multipart/form-data"
                  >
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label>Product Name</label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter Product Name"
                            v-model="form.name"
                          />
                          <small class="text-danger" v-if="errors.name">{{
                            errors.name[0]
                          }}</small>
                        </div>
                        <div class="col-md-6">
                          <label>Product Code</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Enter Product Code"
                            v-model="form.code"
                          />
                          <small class="text-danger" v-if="errors.code">{{
                            errors.code[0]
                          }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-12">
                          <label>Product Description</label>
                          <textarea
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter Product Description"
                            v-model="form.description"
                            rows="3"
                          />
                          <small class="text-danger" v-if="errors.description">
                            {{ errors.description[0] }}
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="exampleFormControlSelect1"
                            >Product Category
                          </label>
                          <select
                            class="form-control"
                            id="exampleFormControlSelect1"
                            v-model="form.category_id"
                          >
                            <option
                              :value="category.id"
                              v-for="category in categories"
                              :key="category.id"
                            >
                              {{ category.name }}
                            </option>
                          </select>

                          <small class="text-danger" v-if="errors.category_id">
                            {{ errors.category_id[0] }}
                          </small>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleFormControlSelect1"
                            >Product Supplier
                          </label>
                          <select
                            class="form-control"
                            id="exampleFormControlSelect1"
                            v-model="form.supplier_id"
                          >
                            <option
                              :value="supplier.id"
                              v-for="supplier in suppliers"
                              :key="supplier.id"
                            >
                              {{ supplier.name }}
                            </option>
                          </select>
                          <small class="text-danger" v-if="errors.supplier_id">
                            {{ errors.supplier_id[0] }}
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-4">
                          <label>Product root</label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            v-model="form.root"
                          />
                          <small class="text-danger" v-if="errors.root">
                            {{ errors.root[0] }}
                          </small>
                        </div>
                        <div class="col-md-4">
                          <label>Product Buying Price</label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="00.00"
                            v-model="form.buying_price"
                          />
                          <small class="text-danger" v-if="errors.buying_price">
                            {{ errors.buying_price[0] }}
                          </small>
                        </div>
                        <div class="col-md-4">
                          <label>Product Selling Price</label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="00.00"
                            v-model="form.selling_price"
                          />
                          <small
                            class="text-danger"
                            v-if="errors.selling_price"
                          >
                            {{ errors.selling_price[0] }}
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                          <label>Buying Date</label>
                          <input
                            type="date"
                            class="form-control"
                            id="exampleInputEmail"
                            aria-describedby="emailHelp"
                            v-model="form.buying_date"
                          />
                          <small
                            class="text-danger"
                            v-if="errors.buying_date"
                            >{{ errors.buying_date[0] }}</small
                          >
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label>Product Image </label>
                          <div class="custom-file">
                            <input
                              type="file"
                              class="custom-file-input"
                              id="customFile"
                              @change="onFileSelected"
                            />
                            <label class="custom-file-label" for="customFile"
                              >Choose file</label
                            >
                          </div>
                          <small class="text-danger" v-if="errors.image">{{
                            errors.image[0]
                          }}</small>
                        </div>
                        <div style="margin-top: 30px">
                          <img
                            :src="form.image"
                            alt=""
                            width="40px"
                            height="40px"
                          />
                        </div>
                        <div class="col-md-5 ml-4">
                          <label for="exampleFormControlSelect1"
                            >Product Status
                          </label>
                          <select
                            class="form-control"
                            id="exampleFormControlSelect1"
                            v-model="form.status"
                          >
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                          </select>

                          <small class="text-danger" v-if="errors.status">
                            {{ errors.status[0] }}
                          </small>
                        </div>
                      </div>
                    </div>

                    <div class="form-group mt-4">
                      <button type="submit" class="btn btn-primary btn-block">
                        Add Product
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
        name: null,
        code: null,
        description: null,
        category_id: null,
        supplier_id: null,
        image: null,
        quantity: null,
        buying_price: null,
        root: null,
        selling_price: null,
        buying_date: null,
        status: null,
      },
      errors: [],
      suppliers: {},
      categories: {},
    };
  },
  methods: {
    storeProduct() {
      axios
        .post("/api/products", this.form)
        .then(() => {
          this.$router.push({ name: "product-index" });
          Notification.success();
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
    onFileSelected(event) {
      var file = event.target.files[0];
      if (file.size > 1048770) {
        // send validation notification
        Notification.image_warning();
      } else {
        var reader = new FileReader();

        reader.onload = (event) => {
          this.form.image = event.target.result;
          console.log(event.target.result);
        };
        reader.readAsDataURL(file);
      }
    },
  },

  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "login" });
    }

    axios
      .get("/api/categories")
      .then(({ data }) => (this.categories = data))
      .catch((error) => error.response.data);
    axios
      .get("/api/suppliers")
      .then(({ data }) => (this.suppliers = data))
      .catch((error) => error.response.data);
  },
};
</script>

<style scoped>
</style>