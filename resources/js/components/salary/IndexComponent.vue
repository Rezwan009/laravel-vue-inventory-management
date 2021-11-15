<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <router-link :to="{ name: 'employee-salary' }" class="btn btn-primary">
        Pay Salary
      </router-link>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <router-link :to="{ name: 'paid-salary' }">PaidSalaries</router-link>
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
            <h6 class="m-0 font-weight-bold text-primary">Salary list</h6>
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
                        <th>Salary Month</th>
                        <th>Details</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="salary in filterSearch" :key="salary.id">
                        <td>
                          {{ salary.salary_month }}
                        </td>

                        <td>
                          <router-link
                            :to="{
                              name: 'view-salary',
                              params: { id: salary.salary_month },
                            }"
                            class="btn btn-sm btn-primary"
                            >View details
                          </router-link>
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
    this.getSalaries();
  },
  data() {
    return {
      salaries: [],
      searchTerm: "",
    };
  },
  methods: {
    getSalaries() {
      axios
        .get("/api/salaries")
        .then(({ data }) => (this.salaries = data))
        .catch((error) => error.response.data);
    },
  },
  computed: {
    filterSearch() {
      return this.salaries.filter((salary) => {
        return salary.salary_month.match(this.searchTerm);
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