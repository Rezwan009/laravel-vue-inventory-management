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
                    @submit.prevent="storeEmployee"
                    class="user"
                    enctype="multipart/form-data"
                  >
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label>Phone No</label>
                          <input
                            type="tel"
                            class="form-control"
                            id="exampleInputEmail"
                            aria-describedby="emailHelp"
                            placeholder="+880 19########"
                            v-model="form.phone"
                          />
                          <small class="text-danger" v-if="errors.phone">{{
                            errors.phone[0]
                          }}</small>
                        </div>
                        <div class="col-md-6">
                          <label>Address</label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter address"
                            v-model="form.address"
                          />
                          <small class="text-danger" v-if="errors.address">{{
                            errors.address[0]
                          }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label>Salary</label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="00.00"
                            v-model="form.salary"
                          />
                          <small class="text-danger" v-if="errors.salary">{{
                            errors.salary[0]
                          }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label>NID</label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            v-model="form.nid"
                          />
                          <small class="text-danger" v-if="errors.nid">{{
                            errors.nid[0]
                          }}</small>
                        </div>
                        <div class="col-md-6">
                          <label>Joining Date</label>
                          <input
                            type="date"
                            class="form-control"
                            id="exampleInputEmail"
                            aria-describedby="emailHelp"
                            v-model="form.joining_date"
                          />
                          <small
                            class="text-danger"
                            v-if="errors.joining_date"
                            >{{ errors.joining_date[0] }}</small
                          >
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
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
                          <small class="text-danger" v-if="errors.photo">{{
                            errors.photo[0]
                          }}</small>
                        </div>
                        <div>
                          <img
                            :src="form.photo"
                            alt=""
                            width="40px"
                            height="40px"
                          />
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
        email: null,
        photo: null,
        address: null,
        salary: null,
        nid: null,
        phone: null,
        joining_date: null,
      },
      errors: [],
    };
  },
  methods: {
    storeEmployee() {
      axios
        .post("/api/employees", this.form)
        .then(() => {
          this.$router.push({ name: "employee-index" });
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
          this.form.photo = event.target.result;
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
  },
};
</script>

<style scoped>
</style>