<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <router-link :to="{ name: 'employee-index' }" class="btn btn-primary">
        All Employee
      </router-link>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item" aria-current="page">
          <router-link :to="{ name: 'employee-index' }">Employees</router-link>
        </li>
        <li class="breadcrumb-item" aria-current="page">Edit</li>
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
                    <h1 class="h4 text-gray-900 mb-4">Pay Salary Form</h1>
                  </div>
                  <form @submit.prevent="paySalary" class="user">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label>Employee Name</label>
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
                        <div class="col-md-6">
                          <label for="exampleFormControlSelect1"
                            >Select Month
                          </label>
                          <select
                            class="form-control"
                            id="exampleFormControlSelect1"
                            v-model="form.salary_month"
                          >
                            <option
                              :value="key"
                              v-for="(month, key) in months"
                              :key="key"
                            >
                              {{ month }}
                            </option>
                          </select>

                          <small class="text-danger" v-if="errors.salary_month">
                            {{ errors.salary_month[0] }}
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group mt-4">
                      <button type="submit" class="btn btn-primary btn-block">
                        Pay Now
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
        name: "",
        email: "",
        salary: "",
        salary_month: "",
      },
      errors: [],
      months: {
        january: "January",
        february: "February",
        march: "March",
        april: "April",
        may: "May",
        jun: "Jun",
        july: "July",
        august: "August",
        september: "September",
        octeber: "Octeber",
        novemebr: "Novemebr",
        december: "December",
      },
    };
  },
  methods: {
    paySalary() {
      let id = this.$route.params.id;
      axios
        .post("/api/salary/paid/" + id, this.form)
        .then(() => {
          this.$router.push({ name: "employee-salary" });
          Notification.success();
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .catch(Notification.warning());
    },
  },

  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "login" });
    }
    // fetching specific row
    let id = this.$route.params.id;
    if (id) {
      axios
        .get("/api/employees/" + id)
        .then(({ data }) => {
          this.form = data;
        })
        .catch(() => {
          console.log("error");
        });
    }
  },
};
</script>

<style scoped>
</style>