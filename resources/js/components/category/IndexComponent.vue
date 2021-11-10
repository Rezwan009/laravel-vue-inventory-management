<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <router-link :to="{ name: 'category-create' }" class="btn btn-primary">
        Add Category
      </router-link>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <router-link :to="{ name: 'category-index' }">Categories</router-link>
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
            <h6 class="m-0 font-weight-bold text-primary">Category list</h6>
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
                        <th>Category name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="category in filterSearch" :key="category.id">
                        <td>
                          <a href="#">{{ category.name }}</a>
                        </td>
                        <td>
                          <router-link
                            :to="{
                              name: 'category-edit',
                              params: { id: category.id },
                            }"
                            class="btn btn-sm btn-primary"
                            >Edit</router-link
                          >
                          <a
                            @click="deleteRecord(category.id)"
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
    this.getCategories();
  },
  data() {
    return {
      categories: [],
      searchTerm: "",
    };
  },
  methods: {
    getCategories() {
      axios
        .get("/api/categories/")
        .then(({ data }) => (this.categories = data))
        .catch();
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
            .delete("/api/categories/" + id)
            .then(() => {
              this.categories = this.categories.filter((category) => {
                return category.id != id;
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
      return this.categories.filter((category) => {
        return category.name.match(this.searchTerm);
      });
    },
  },
};
</script>

<style scoped>
#search {
  width: 400px;
}
</style>