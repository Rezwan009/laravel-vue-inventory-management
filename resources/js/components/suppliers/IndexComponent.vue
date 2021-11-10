<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <router-link :to="{ name: 'supplier-create' }" class="btn btn-primary">
        Add Supplier
      </router-link>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <router-link :to="{ name: 'supplier-index' }">Suppliers</router-link>
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
            <h6 class="m-0 font-weight-bold text-primary">Supplier list</h6>
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
                        <th>Phone</th>
                        <th>Shop Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="supplier in filterSearch" :key="supplier.id">
                        <td>
                          <a href="#">{{ supplier.name }}</a>
                        </td>
                        <td>
                          <img
                            :src="getSupplierPhoto() + supplier.photo"
                            id="photo"
                            v-show="supplier.photo ? true : false"
                          />
                        </td>
                        <td>{{ supplier.phone }}</td>
                        <td>
                          <span class="badge badge-success">
                            {{ supplier.shop_name }}
                          </span>
                        </td>
                        <td>
                          <router-link
                            :to="{
                              name: 'supplier-edit',
                              params: { id: supplier.id },
                            }"
                            class="btn btn-sm btn-primary"
                            >Edit</router-link
                          >
                          <a
                            @click="deleteRecord(supplier.id)"
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
    this.getSuppliers();
  },
  data() {
    return {
      suppliers: [],
      searchTerm: "",
    };
  },
  methods: {
    getSuppliers() {
      axios
        .get("/api/suppliers/")
        .then(({ data }) => (this.suppliers = data))
        .catch();
    },
    getSupplierPhoto() {
      return "backend/assets/img/supplier/";
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
            .delete("/api/suppliers/" + id)
            .then(() => {
              this.suppliers = this.suppliers.filter((supplier) => {
                return supplier.id != id;
              });
            })
            .catch(() => {});
          Swal.fire("Deleted!", "Your data has been deleted.", "success");
        }
      });
    },
  },
  computed: {
    filterSearch() {
      return this.suppliers.filter((supplier) => {
        return supplier.name.match(this.searchTerm);
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