
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
          <router-link :to="{ name: 'employee-index' }">Employees</router-link>
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
            <h6 class="m-0 font-weight-bold text-primary">Employee list</h6>
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
                        <th>Salary</th>
                        <th>Joining date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="employee in filterSearch" :key="employee.id">
                        <td>
                          <a href="#">{{ employee.name }}</a>
                        </td>
                        <td>
                          <img
                            :src="getEmployeePhoto() + employee.photo"
                            id="photo"
                            v-show="employee.photo ? true : false"
                          />
                        </td>
                        <td>{{ employee.phone }}</td>
                        <td>{{ employee.salary }}</td>
                        <td>
                          <span class="badge badge-success">
                            {{ employee.joining_date }}
                          </span>
                        </td>
                        <td>
                          <router-link
                            :to="{
                              name: 'pay-salary',
                              params: { id: employee.id },
                            }"
                            class="btn btn-sm btn-primary"
                          >
                            Pay Salary
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
    this.getEmployees();
  },
  data() {
    return {
      employees: [],
      searchTerm: "",
    };
  },
  methods: {
    getEmployees() {
      axios
        .get("/api/employees")
        .then(({ data }) => (this.employees = data))
        .catch();
    },
    getEmployeePhoto() {
      return "/backend/assets/img/employee/";
    },
  },
  computed: {
    filterSearch() {
      return this.employees.filter((employee) => {
        return employee.name.match(this.searchTerm);
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