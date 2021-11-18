<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <router-link :to="{ name: 'order-index' }">Orders</router-link>
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
              Today's Order list
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
                        <th>Customer Name</th>
                        <th>Total</th>
                        <th>Paid amount</th>
                        <th>Due amount</th>
                        <th>Payment Method</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in filterSearch" :key="order.id">
                        <td>
                          <a href="#">{{ order.name }}</a>
                        </td>
                        <td>{{ order.total }} $</td>
                        <td>{{ order.paid_amount }} $</td>
                        <td>{{ order.due_amount }} $</td>
                        <td>
                          {{ order.payment_method }}
                        </td>
                        <td>
                          <router-link
                            :to="{
                              name: 'view-order',
                              params: { id: order.id },
                            }"
                            class="btn btn-sm btn-primary"
                            >View Order</router-link
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
    this.todaysOrder();
  },
  data() {
    return {
      orders: [],
      searchTerm: "",
    };
  },
  methods: {
    todaysOrder() {
      axios
        .get("/api/today-orders")
        .then(({ data }) => (this.orders = data))
        .catch((error) => error.response.data);
    },
  },
  computed: {
    filterSearch() {
      return this.orders.filter((order) => {
        return order.name.match(this.searchTerm);
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