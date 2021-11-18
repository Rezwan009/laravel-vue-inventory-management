<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <router-link :to="{ name: 'today-order' }">Orders</router-link>
        </li>
        <li class="breadcrumb-item" aria-current="page">Data</li>
      </ol>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <form @submit.prevent="searchOrder">
          <div class="form-group">
            <label for="date">Search by Date</label>
            <input type="date" v-model="date" class="form-control" required />
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary form-control">
              Search
            </button>
          </div>
        </form>
      </div>
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
            <h6 class="m-0 font-weight-bold text-primary">Order list</h6>
          </div>

          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <!-- Table goes here -->
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Customer Name</th>
                        <th>Qty</th>
                        <th>Sub total</th>
                        <th>vat</th>
                        <th>Total</th>
                        <th>Pay amount</th>
                        <th>Due amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in orders" :key="order.id">
                        <td>
                          <a href="#">{{ order.name }}</a>
                        </td>
                        <td>{{ order.quantity }} $</td>
                        <td>{{ order.subTotal }} $</td>

                        <td>{{ order.vat }} %</td>

                        <td>{{ order.total }} $</td>

                        <td>{{ order.paid_amount }} $</td>
                        <td>{{ order.due_amount }} $</td>
                      </tr>
                      <!-- <td v-show="toggle">No data found</td> -->
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
  },
  data() {
    return {
      orders: [],
      date: "",
      toggle: true,
    };
  },
  methods: {
    searchOrder() {
      var data = { date: this.date };
      axios
        .post("/api/search-orders", data)
        .then(({ data }) => {
          this.orders = data;
        })
        .catch((error) => error.response.data);
    },
  },
  computed: {},
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