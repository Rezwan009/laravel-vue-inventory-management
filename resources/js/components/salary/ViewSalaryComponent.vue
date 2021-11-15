
<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <router-link :to="{ name: 'paid-salary' }" class="btn btn-primary">
        Paid Salary
      </router-link>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <router-link :to="{ name: 'paid-salary' }">Paid Salaries</router-link>
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
            <h6 class="m-0 font-weight-bold text-primary">
              Employee Salary Details
            </h6>
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
                        <th>Employee name</th>
                        <th>Amount</th>
                        <th>Month</th>
                        <th>Dates</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="salary in filterSearch" :key="salary.id">
                        <td>
                          <router-link :to="{ name: 'employee-index' }">{{
                            salary.name
                          }}</router-link>
                        </td>
                        <td>{{ salary.amount }}</td>
                        <td>{{ salary.salary_month }}</td>
                        <td>
                          <span class="badge badge-success">
                            {{ salary.salary_date }}
                          </span>
                        </td>
                        <td>
                          <router-link
                            :to="{
                              name: 'salary-edit',
                              params: { id: salary.id },
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
    this.viewSalary();
  },
  data() {
    return {
      salaries: [],
      searchTerm: "",
    };
  },
  methods: {
    viewSalary() {
      let id = this.$route.params.id;
      if (id) {
        axios
          .get("/api/salary-details/" + id)
          .then(({ data }) => {
            this.salaries = data;
          })
          .catch(() => {
            console.log("error");
          });
      }
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
#search {
  width: 400px;
}
</style>