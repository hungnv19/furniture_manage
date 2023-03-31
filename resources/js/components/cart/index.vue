<template>
  <div class="container-fluid">
    <div class="card">
      <div class="row">
        <div class="col-md-8 cart">
          <div class="title">
            <div class="row">
              <div class="col">
                <h4><b>Shopping Cart</b></h4>
              </div>
              <div class="col align-self-center text-right text-muted">
                3 items
              </div>
            </div>
          </div>

          <div class="table-responsive" style="font-size: 12px">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th style="text-align: center">Quantity</th>
                  <th>Unit</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in pos" :key="item.id">
                  <td>{{ item.product_name }}</td>
                  <td>
                    <div
                      class="d-flex justify-content-center bootstrap-touchspin bootstrap-touchspin-injected"
                    >
                      <span class="input-group-btn input-group-prepend">
                        <button
                          @click.prevent="decrement(item.id)"
                          class="btn btn-primary btn-sm bootstrap-touchspin-down text-color action"
                          type="button"
                          :disabled="
                            item.product_quantity <= 1 || nameButton[item.id]
                          "
                        >
                          -
                        </button>
                      </span>
                      <span
                        class="d-flex justify-content-center"
                        style="width: 30px"
                      >
                        <div>{{ item.product_quantity }}</div>
                      </span>
                      <span class="input-group-btn input-group-append">
                        <button
                          :disabled="
                            item.product_quantity >=
                              products.find((x) => {
                                return x.id == item.product_id;
                              }).product_quantity || nameButton[item.id]
                          "
                          @click.prevent="
                            increment(
                              item.id,
                              item.product_id,
                              item.product_quantity
                            )
                          "
                          class="btn btn-primary btn-sm bootstrap-touchspin-up text-color action"
                          type="button"
                        >
                          +
                        </button>
                      </span>
                    </div>
                  </td>
                  <td>{{ number_format(item.product_price) }}</td>
                  <td>{{ number_format(item.sub_total) }}</td>
                  <td>
                    <a
                      @click="deleteItem(item.id)"
                      class="btn btn-sm btn-danger action"
                      style="color: white"
                      >X</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="back-to-shop">
            <a href="#">&leftarrow;</a
            ><span class="text-muted">Back to shop</span>
          </div>
        </div>
        <div class="col-md-4 summary">
          <div>
            <h5><b>Summary</b></h5>
          </div>
          <hr />
          <div class="row">
            <div class="col" style="padding-left: 0">ITEMS 3</div>
            <div class="col text-right">&euro; 132.00</div>
          </div>
          <form>
            <p>SHIPPING</p>
            <select>
              <option class="text-muted">Standard-Delivery- &euro;5.00</option>
            </select>
            <p>GIVE CODE</p>
            <input id="code" placeholder="Enter your code" />
          </form>
          <div
            class="row"
            style="border-top: 1px solid rgba(0, 0, 0, 0.1); padding: 2vh 0"
          >
            <div class="col">TOTAL PRICE</div>
            <div class="col text-right">&euro; 137.00</div>
          </div>
          <button class="btn">CHECKOUT</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    console.log(this.pos);
  },
  props: ["data"],
  mounted() {},

  data() {
    return {
      pos: [],
    };
  },

  computed: {},

  methods: {
    async decrement(id) {
      this.nameButton[id] = true;
      this.nameButton = JSON.parse(JSON.stringify(this.nameButton));

      await axios
        .get("/api/cart/decrement/" + id)
        .then(() => {
          Reload.$emit("afterAddToCart");
          Notification.success(this.$t("common.message.success"));
          this.sleep(1000).then(() => {
            this.nameButton[id] = false;
            this.nameButton = JSON.parse(JSON.stringify(this.nameButton));
          });
        })
        .catch();
    },
  },
};
</script>




<style scoped>
body {
  background: #ddd;
  min-height: 100vh;
  vertical-align: middle;
  display: flex;
  font-family: sans-serif;
  font-size: 0.8rem;
  font-weight: bold;
}
.title {
  margin-bottom: 5vh;
}
.card {
  margin: auto;
  max-width: 100%;
  width: 100%;
  box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  border-radius: 1rem;
  border: transparent;
}
@media (max-width: 767px) {
  .card {
    margin: 3vh auto;
  }
}
.cart {
  background-color: #fff;
  padding: 4vh 5vh;
  border-bottom-left-radius: 1rem;
  border-top-left-radius: 1rem;
}
@media (max-width: 767px) {
  .cart {
    padding: 4vh;
    border-bottom-left-radius: unset;
    border-top-right-radius: 1rem;
  }
}
.summary {
  background-color: #ddd;
  border-top-right-radius: 1rem;
  border-bottom-right-radius: 1rem;
  padding: 4vh;
  color: rgb(65, 65, 65);
}
@media (max-width: 767px) {
  .summary {
    border-top-right-radius: unset;
    border-bottom-left-radius: 1rem;
  }
}
.summary .col-2 {
  padding: 0;
}
.summary .col-10 {
  padding: 0;
}
.row {
  margin: 0;
}
.title b {
  font-size: 1.5rem;
}
.main {
  margin: 0;
  padding: 2vh 0;
  width: 100%;
}
.col-2,
.col {
  padding: 0 1vh;
}
a {
  padding: 0 1vh;
}
.close {
  margin-left: auto;
  font-size: 0.7rem;
}
img {
  width: 3.5rem;
}
.back-to-shop {
  margin-top: 4.5rem;
}
h5 {
  margin-top: 4vh;
}
hr {
  margin-top: 1.25rem;
}
form {
  padding: 2vh 0;
}
select {
  border: 1px solid rgba(0, 0, 0, 0.137);
  padding: 1.5vh 1vh;
  margin-bottom: 4vh;
  outline: none;
  width: 100%;
  background-color: rgb(247, 247, 247);
}
input {
  border: 1px solid rgba(0, 0, 0, 0.137);
  padding: 1vh;
  margin-bottom: 4vh;
  outline: none;
  width: 100%;
  background-color: rgb(247, 247, 247);
}
input:focus::-webkit-input-placeholder {
  color: transparent;
}
.btn {
  background-color: #000;
  border-color: #000;
  color: white;
  width: 100%;
  font-size: 0.7rem;
  margin-top: 4vh;
  padding: 1vh;
  border-radius: 0;
}
.btn:focus {
  box-shadow: none;
  outline: none;
  box-shadow: none;
  color: white;
  -webkit-box-shadow: none;
  -webkit-user-select: none;
  transition: none;
}
.btn:hover {
  color: white;
}
a {
  color: black;
}
a:hover {
  color: black;
  text-decoration: none;
}
#code {
  background-image: linear-gradient(
      to left,
      rgba(255, 255, 255, 0.253),
      rgba(255, 255, 255, 0.185)
    ),
    url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
  background-repeat: no-repeat;
  background-position-x: 95%;
  background-position-y: center;
}
</style>