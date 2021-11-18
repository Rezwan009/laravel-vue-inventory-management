<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between">
      <router-link :to="{ name: 'today-order' }" class="btn btn-primary">
        Go Back
      </router-link>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item" aria-current="page">
          <router-link :to="{ name: 'today-order' }">Orders</router-link>
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
                    <h1 class="h4 text-gray-900 mb-4">Order Details</h1>
                  </div>

                  <div class="row">
                    <div class="col-lg-6 mb-4">
                      <!-- Simple Tables -->
                      <div class="card">
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
                            Order
                          </h6>
                        </div>
                        <div class="table-responsive">
                          <ul class="list-group">
                            <li class="list-group-item">
                              <b>Name:</b> {{ orders.name }}
                            </li>
                            <li class="list-group-item">
                              <b>Phone:</b> {{ orders.phone }}
                            </li>
                            <li class="list-group-item">
                              <b>Address:</b> {{ orders.address }}
                            </li>
                            <li class="list-group-item">
                              <b>Date:</b> {{ orders.order_date }}
                            </li>
                            <li class="list-group-item">
                              <b>Pay Through:</b> {{ orders.payment_method }}
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                      <!-- Simple Tables -->
                      <div class="card">
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
                            Details
                          </h6>
                        </div>
                        <div class="table-responsive">
                          <ul class="list-group">
                            <li class="list-group-item">
                              <b>Sub Total:</b> {{ orders.subTotal }} $
                            </li>
                            <li class="list-group-item">
                              <b>Vat:</b> {{ orders.vat }} %
                            </li>
                            <li class="list-group-item">
                              <b>Total:</b> {{ orders.total }} $
                            </li>
                            <li class="list-group-item">
                              <b>Pay amount:</b> {{ orders.paid_amount }} $
                            </li>
                            <li class="list-group-item">
                              <b>Due amount:</b> {{ orders.due_amount }} $
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 mb-4">
                      <!-- Simple Tables -->
                      <div class="card">
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
                            Orders
                          </h6>
                        </div>
                        <div class="table-responsive">
                          <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr>
                                <th>Product Name</th>
                                <th>Code</th>
                                <th>Image</th>
                                <th>Qty</th>
                                <th>Unti Price</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr
                                v-for="detail in order_details"
                                :key="detail.id"
                              >
                                <td>{{ detail.name }}</td>
                                <td>{{ detail.code }}</td>
                                <td>
                                  <img
                                    :src="getProductPhoto() + detail.image"
                                    id="photo"
                                  />
                                </td>
                                <td>
                                  <span class="badge badge-success">{{
                                    detail.product_qty
                                  }}</span>
                                </td>
                                <td>{{ detail.product_price }} $</td>
                                <td>{{ detail.sub_total }} $</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="card-footer"></div>
                      </div>
                    </div>
                  </div>
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
      orders: [],
      order_details: [],
      errors: [],
    };
  },
  methods: {
    getProductPhoto() {
      return "/backend/assets/img/product/";
    },
  },

  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "login" });
    }
    let id = this.$route.params.id;
    axios
      .get("/api/order/order-details/" + id)
      .then(({ data }) => {
        this.order_details = data;
      })
      .catch((error) => (this.errors = error.response.data.errors));
    axios
      .get("/api/order/details/" + id)
      .then(({ data }) => {
        this.orders = data;
      })
      .catch((error) => (this.errors = error.response.data.errors));
  },
};
</script>

<style scoped>
#photo {
  width: 40;
  height: 30px;
}
</style>