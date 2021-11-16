<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <router-link :to="{ name: 'customer-create' }" class="btn btn-primary">
        Add Customer
      </router-link>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <router-link :to="{ name: 'customer-index' }">Customers</router-link>
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
            <h6 class="m-0 font-weight-bold text-primary">Customer list</h6>
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
                        <th>Full name</th>
                        <th>Photo</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="customer in filterSearch" :key="customer.id">
                        <td>
                          <a href="#">{{ customer.name }}</a>
                        </td>
                        <td>
                          <img
                            :src="getCustomerPhoto() + customer.photo"
                            id="photo"
                            v-show="customer.photo ? true : false"
                          />
                        </td>
                        <td>{{ customer.email }}</td>
                        <td>{{ customer.phone }}</td>

                        <td>
                          <router-link
                            :to="{
                              name: 'customer-edit',
                              params: { id: customer.id },
                            }"
                            class="btn btn-sm btn-primary"
                            >Edit</router-link
                          >
                          <a
                            @click="deleteRecord(customer.id)"
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
    this.getCustomer();
  },
  data() {
    return {
      customers: [],
      searchTerm: "",
    };
  },
  methods: {
    getCustomer() {
      axios
        .get("/api/customers")
        .then(({ data }) => (this.customers = data))
        .catch();
    },
    getCustomerPhoto() {
      return "backend/assets/img/customer/";
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
            .delete("/api/customers/" + id)
            .then(() => {
              this.customers = this.customers.filter((customer) => {
                return customer.id != id;
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
      return this.customers.filter((customer) => {
        return customer.name.match(this.searchTerm);
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