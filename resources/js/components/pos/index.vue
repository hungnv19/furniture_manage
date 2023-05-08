<template>
  <div>
    <div class="row mb-3">
      <!-- Area Chart -->
      <div class="col-xl-4 col-lg-5">
        <div class="card mb-4">
          <div class="card-body">
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
                  <!-- <tr v-for="pro in cartProduct" :key="pro.id">
                    <td>{{ pro.product_name }}</td>
                    <td>
                      <div
                        class="d-flex justify-content-center bootstrap-touchspin bootstrap-touchspin-injected"
                      >
                        <span class="input-group-btn input-group-prepend">
                          <button
                            @click.prevent="decrement(pro.id)"
                            class="btn btn-primary btn-sm bootstrap-touchspin-down text-color action"
                            type="button"
                            :disabled="
                              pro.product_quantity <= 1 || nameButton[pro.id]
                            "
                          >
                            -
                          </button>
                        </span>
                        <span
                          class="d-flex justify-content-center"
                          style="width: 30px"
                        >
                          <div>{{ pro.product_quantity }}</div>
                        </span>
                        <span class="input-group-btn input-group-append">
                          <button
                            :disabled="
                              pro.product_quantity >=
                                products.find((x) => {
                                  return x.id == pro.product_id;
                                }).product_quantity || nameButton[pro.id]
                            "
                            @click.prevent="
                              increment(
                                pro.id,
                                pro.product_id,
                                pro.product_quantity
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
                    <td>{{ number_format(pro.product_price) }}</td>
                    <td>{{ number_format(pro.sub_total) }}</td>
                    <td>
                      <a
                        @click="deleteItem(pro.id)"
                        class="btn btn-sm btn-danger action"
                        style="color: white"
                        >X</a
                      >
                    </td>
                  </tr> -->
                </tbody>
              </table>
            </div>
          </div>
          <!-- <input
            type="hidden"
            name="qty"
            v-validate="'required|numeric|min_value:1'"
            v-model="qty"
          />
          <div class="px-4">
            <small class="text-danger">{{ errors.first("qty") }}</small>
          </div> -->
          <div class="card-footer">
            <div class="order-md-2 mb-4">
              <ul class="list-group mb-3">
                <li
                  class="list-group-item d-flex justify-content-between lh-condensed"
                >
                  <div>
                    <h6 class="my-0">Total Quantity</h6>
                  </div>
                  <!-- <span class="text-muted">{{ qty }}</span> -->
                </li>
                <li
                  class="list-group-item d-flex justify-content-between lh-condensed"
                >
                  <div>
                    <h6 class="my-0">Sub Total</h6>
                  </div>
                  <!-- <span class="text-muted">{{ number_format(sub_total) }}</span> -->
                </li>

                <li
                  class="list-group-item d-flex justify-content-between lh-condensed"
                >
                  <div>
                    <h6 class="my-0">Vat</h6>
                  </div>
                  <!-- <span class="text-muted">{{ this.vat }}%</span> -->
                </li>
                <li
                  class="list-group-item d-flex justify-content-between bg-light"
                >
                  <div class="text-success">
                    <h6 class="my-0">Total</h6>
                  </div>
                  <!-- <span class="text-success">{{ number_format(total) }}</span> -->
                </li>
                <li
                  v-if="giftCardId"
                  class="list-group-item d-flex justify-content-between lh-condensed"
                >
                  <div>
                    <h6 class="my-0">Gift Card</h6>
                  </div>
                  <!-- <span class="text-muted"> - {{ number_format(total) }}</span> -->
                </li>
              </ul>

              <form @submit.prevent="orderDone">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Customer</label>
                  <!-- <Select2
                    @select="selectCustomerId($event)"
                    :options="myOptions"
                    :placeholder="
                      this.$t('common.label.select', {
                        category: $t('common.category.customer'),
                      })
                    "
                  />
                  <input
                    type="hidden"
                    name="customer_id"
                    v-validate="'required'"
                    v-model="customer_id"
                  />
                  <small class="text-danger">{{
                    errors.first("customer_id")
                  }}</small> -->
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect2">Pay By</label>
                  <select
                    class="form-control"
                    id="exampleFormControlSelect2"
                    name="payBy"
                    v-model="payBy"
                    v-validate="'required'"
                  >
                    <option value="handCash">Hand Cash</option>
                    <option value="giftCard">Gift Card</option>
                  </select>
                  <!-- <small class="text-danger">{{ errors.first("payBy") }}</small> -->
                </div>

                <!-- <div v-if="payBy === 'giftCard'" class="form-group">
                  <label for="exampleFormControlSelect2">{{
                    $t("content.orders.method.gift_card")
                  }}</label>
                  <Select2
                    @select="selectGiftCard($event)"
                    :options="giftCardOptions"
                    :placeholder="this.$t('common.label.select_card')"
                  />
                  <input
                    type="hidden"
                    name="gift_card_id"
                    v-model="giftCardId"
                    v-validate="
                      payBy === 'giftCard'
                        ? 'required|valid_card'
                        : 'valid_card'
                    "
                  />
                  <small class="text-danger">{{
                    errors.first("gift_card_id")
                  }}</small>
                </div> -->
                <!-- <div v-if="payBy === 'handCash'">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">{{
                      $t("content.orders.list.pay")
                    }}</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="pay"
                      v-validate="
                        payBy === 'handCash'
                          ? 'required|numeric|min_value:' + total
                          : 'numeric|min_value:0'
                      "
                      name="pay"
                      id="exampleFormControlInput1"
                      @keyup="calculatorDue"
                    />
                    <small class="text-danger">{{ errors.first("pay") }}</small>
                  </div>
                  <div class="form-group">
                    <div class="d-flex justify-content-between">
                      <label for="exampleFormControlInput2">{{
                        $t("content.orders.list.due")
                      }}</label>
                      <label for="">{{
                        this.number_format(pay - this.total)
                      }}</label>
                    </div>
                    <input
                      type="hidden"
                      class="form-control"
                      v-model="due"
                      name="due"
                      id="exampleFormControlInput2"
                    />
                  </div>
                </div> -->

                <button class="btn btn-success" type="submit">submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Pie Chart -->
      <div class="col-xl-8 col-lg-7">
        <div class="card mb-4">
          <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
          >
            <h5 class="m-0 font-weight-bold text-primary">products</h5>
          </div>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a
                class="nav-link active"
                id="home-tab"
                data-toggle="tab"
                href="#home"
                role="tab"
                aria-controls="home"
                aria-selected="true"
                >home</a
              >
            </li>

            <!-- <li
              class="nav-item"
              role="presentation"
              v-for="category in categories"
              :key="category.id"
            >
              <a
                class="nav-link"
                id="profile-tab"
                data-toggle="tab"
                href="#profile"
                role="tab"
                aria-controls="profile"
                aria-selected="false"
                @click="categoryProduct(category.id)"
                >{{ category.category_name }}</a
              >
            </li> -->
          </ul>
          <div class="tab-content" id="myTabContent">
            <div
              class="tab-pane fade show active"
              id="home"
              role="tabpanel"
              aria-labelledby="home-tab"
            >
              <div class="card-body">
                <div class="row">
                  <div
                    class="col-lg-3 col-md-3 col-sm-6 col-6"
                    v-for="item in filterSearch"
                    :key="item.id"
                  >
                    <div
                      class="card"
                      style="align-items: center; margin-bottom: 10px"
                    >
                      <button
                        class="btn btn-sm"
                        :class="disableButton ? 'pointer-events-none' : ''"
                        @click.prevent="
                          addToCart(item.id, item.product_quantity)
                        "
                      >
                        <div class="img-container">
                          <img
                            :src="
                              item.image
                                ? item.image
                                : '/backend/img/none-img.jpg'
                            "
                            class="card-img-top"
                            id="image_size"
                            alt="..."
                          />
                        </div>
                        <div class="card-body">
                          <h5 class="card-title text-center">
                            {{ item.product_name }} -
                            {{ number_format(item.selling_price) }}
                          </h5>
                          <td v-if="item.product_quantity >= 1">
                            <span class="badge badge-success"
                              >available
                              <span class="badge badge-light">{{
                                item.product_quantity
                              }}</span></span
                            >
                          </td>
                          <td v-else>
                            <span class="badge badge-danger">stock_out</span>
                          </td>
                        </div>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="tab-pane fade"
              id="profile"
              role="tabpanel"
              aria-labelledby="profile-tab"
            >
              <div class="card-body">
                <div class="row">
                  
                  <div
                    class="col-lg-3 col-md-3 col-sm-6 col-6"
                  >
                    <!-- v-for="catProduct in filterCatSearch"
                    :key="catProduct.id" -->
                    <div
                      class="card"
                      style="align-items: center; margin-bottom: 10px"
                    >
                      <button
                        class="btn btn-sm"
                        @click.prevent="
                          addToCart(catProduct.id, catProduct.product_quantity)
                        "
                      >
                        <!-- <div class="img-container">
                          <img
                            :src="catProduct.image"
                            class="card-img-top"
                            id="image_size"
                            alt="..."
                          />
                        </div> -->
                        
                        <div class="card-body">
                          <h5 class="card-title text-center">
                            {{ product.product_name }} -
                            {{ number_format(product.selling_price) }}
                          </h5>
                          <td v-if="product.product_quantity >= 1">
                            <span class="badge badge-success"
                              >available
                              <span class="badge badge-light">{{
                                product.product_quantity
                              }}</span></span
                            >
                          </td>
                          <td v-else>
                            <span class="badge badge-danger">stock_out</span>
                          </td>
                        </div>
                      </button>
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
  created() {
    let messError = {
      custom: {
        qty: {
          required: "Please select at least 1 product.",
          min_value: "Please select at least 1 product.",
        },
        customer_id: {
          required: "The customer field is required.",
        },
        pay: {
          required: "The pay field is required.",
          numeric: "Please enter a number.",
          min_value: "Please enter a number greater than Total.",
        },
        due: {
          numeric: "Please enter a number.",
          min_value: "Please enter a number greater than 0.",
        },
        payBy: {
          required: "The pay by field is required.",
        },
        gift_card_id: {
          required: "Please select a gift card for payment.",
          valid_card: "Card balance is not enough.",
        },
      },
    };

    let that = this;

  },
  components: {},

  mounted() {
    this.allProduct();
    this.allCategory(); 
    // this.allCustomers();
    this.cartProducts();
    // Reload.$on("afterAddToCart", () => {
    //   this.cartProducts();
    // });
  },
  // computed: {
  //   filterSearch() {
  //     return this.products.filter((product) => {
  //       return product.product_name.match(new RegExp(this.searchTerm, "i"));
  //     });
  //   },
  //   filterCatSearch() {
  //     return this.categoryProducts.filter((catProduct) => {
  //       return catProduct.product_name.match(new RegExp(this.searchTerm, "i"));
  //     });
  //   },
  //   qty() {
  //     let sum = 0;
  //     for (let i = 0; i < this.cartProduct.length; i++) {
  //       sum += parseFloat(this.cartProduct[i].product_quantity);
  //     }

  //     return sum;
  //   },
  //   sub_total() {
  //     let sum = 0;
  //     for (let i = 0; i < this.cartProduct.length; i++) {
  //       sum += parseFloat(this.cartProduct[i].sub_total);
  //     }

  //     return sum;
  //   },

  //   total() {
  //     return parseFloat(
  //       this.number_format(
  //         Math.round(
  //           ((this.sub_total * this.vat) / 100 + this.sub_total) * 100
  //         ) / 100
  //       )
  //         .replace(/\./g, "")
  //         .replace("₫", "")
  //     );
  //   },
  // },
  data() {
    return {
      products: [],
      categories: [],
      categoryProducts: [],
      customers: [],
      cartProduct: [],
      searchTerm: "",
      vat: Laravel.VAT,
      product: {},
      // Form
      customer_id: "",
      pay: "",
      due: "",
      payBy: "",

      disableButton: false,
      amount: 0,
      myOptions: [],
      nameButton: {},

      giftCardId: "",
      giftCardOptions: [],
      listGiftCard: [],
      cardSelected: "",
      cardBalance: "",
    };
  },

  computed: {
    qty() {
      let sum = 0;
      for (let i = 0; i < this.cartProduct.length; i++) {
        sum += parseFloat(this.cartProduct[i].product_quantity);
      }

      return sum;
    },
    sub_total() {
      let sum = 0;
      for (let i = 0; i < this.cartProduct.length; i++) {
        sum += parseFloat(this.cartProduct[i].sub_total);
      }

      return sum;
    },

    total() {
      return parseFloat(
        this.number_format(
          Math.round(
            ((this.sub_total * this.vat) / 100 + this.sub_total) * 100
          ) / 100
        )
          .replace(/\./g, "")
          .replace("₫", "")
      );
    },
  },

  methods: {
    allProduct() {
      axios
        .get("/product")
        .then(({ data }) => (this.products = data))
        .catch();
    },
    allCategory() {
      axios
        .get("/category")
        .then(({ data }) => (this.categories = data))
        .catch();
    },
    categoryProduct(id) {
      axios
        .get("/category/product/" + id)
        .then(({ data }) => (this.categoryProducts = data))
        .catch();
    },
    // allCustomers() {
    //   axios
    //     .get("/customer")
    //     .then(({ data }) => {
    //       this.customers = data;
    //       this.customers.map((e) => {
    //         this.myOptions.push({ id: e.id, text: e.name });
    //       });
    //     })
    //     .catch();
    // },

    // Cart
    async addToCart(id, product_quantity) {
      if (product_quantity <= 0) {
        return;
      } else {
        this.disableButton = true;
        if (this.cartProduct.length == 0) {
          this.addItemToCard(id);
        } else {
          for (const item of this.cartProduct) {
            if (item.product_id === id) {
              await axios
                .get("/product/" + id)
                .then(async (res) => {
                  let product = res.data;
                  if (product.product_quantity > item.product_quantity) {
                    await this.addItemToCard(id);
                  } else {
                    this.disableButton = false;
                  }
                })
                .catch();
            } else {
              let flag = this.cartProduct
                .map((e) => {
                  return e.product_id;
                })
                .indexOf(id);
              if (flag == -1) {
                this.addItemToCard(id);
                return;
              }
            }
          }
        }
      }
    },
    addItemToCard(id) {
      axios
        .get("/addToCart/" + id)
        .then(() => {
          Reload.$emit("afterAddToCart");
          Notification.cart_success(this.$t("common.message.add_cart_success"));

          this.sleep(100).then(() => {
            this.disableButton = false;
          });
        })
        .catch();
    },
    cartProducts() {
      axios
        .get("/cart-product")
        .then(({ data }) => (this.cartProduct = data))
        .catch();
    },
    deleteItem(id) {
      axios
        .get("/cart/delete/" + id)
        .then(() => {
          Reload.$emit("afterAddToCart");
          Notification.cart_delete(this.$t("common.message.cart_deleted"));
        })
        .catch();
    },
    async increment(id, product_id, product_quantity) {
      this.nameButton[id] = true;
      this.nameButton = JSON.parse(JSON.stringify(this.nameButton));

      await axios
        .get("/product/" + product_id)
        .then(async (res) => {
          let product = res.data;
          if (product.product_quantity > product_quantity) {
            await axios
              .get("/cart/increment/" + id)
              .then(() => {
                Reload.$emit("afterAddToCart");
                Notification.success(this.$t("common.message.success"));
                this.sleep(100).then(() => {
                  this.nameButton[id] = false;
                  this.nameButton = JSON.parse(JSON.stringify(this.nameButton));
                });
              })
              .catch();
          }
        })
        .catch();
    },
    async decrement(id) {
      this.nameButton[id] = true;
      this.nameButton = JSON.parse(JSON.stringify(this.nameButton));

      await axios
        .get("/cart/decrement/" + id)
        .then(() => {
          Reload.$emit("afterAddToCart");
          Notification.success(this.$t("common.message.success"));
          this.sleep(100).then(() => {
            this.nameButton[id] = false;
            this.nameButton = JSON.parse(JSON.stringify(this.nameButton));
          });
        })
        .catch();
    },

    orderDone() {
      this.$validator.validateAll().then((valid) => {
        if (valid) {
          this.isLoading = true;
          var data = {
            qty: this.qty,
            sub_total: this.sub_total,
            customer_id: this.customer_id,
            pay: this.pay,
            due: this.due,
            payBy: this.payBy,
            vat: this.vat,
            total: this.total,
            gift_card_id: this.giftCardId,
          };

          axios
            .post("/order", data)
            .then((res) => {
              if (res && res.data.result == true) {
                this.isLoading = false;
                this.$router.push({ name: "home" });
                Notification.success(this.$t("common.message.success"));
              } else {
                Notification.error(this.$t("common.message.error"));
              }
            })
            .catch((error) => {
              this.isLoading = false;
              Notification.error(this.$t("common.message.error"));
            });
        } else {
          this.isLoading = false;
          this.$el
            .querySelector(
              "input[name=" + Object.keys(this.errors.collect())[0] + "]"
            )
            .focus();
          $("html, body").animate(
            {
              scrollTop:
                $(
                  "input[name=" + Object.keys(this.errors.collect())[0] + "]"
                ).offset().top - 104,
            },
            500
          );
        }
      });
    },
    number(string) {
      return string;
    },
    selectCustomerId(e) {
      this.customer_id = e.id;
      this.giftCardOptions = [];
      this.listGiftCard = [];
      this.giftCardId = "";
      this.cardSelected = "";
      axios
        .get("/customer/" + this.customer_id)
        .then((res) => {
          if (res) {
            res.data.gift_cards.map((e) => {
              if (e.balance !== 0) {
                this.listGiftCard.push(e);
                this.giftCardOptions.push({
                  id: e.id,
                  text: e.code + " - " + this.number_format(e.balance),
                });
              }
            });
          }
        })
        .catch((err) => {
          Notification.error(this.$t("common.message.error"));
        });
    },

    selectGiftCard(e) {
      this.giftCardId = e.id;
      this.cardSelected = this.listGiftCard.filter((el) => {
        return el.id == e.id;
      })[0];
      this.cardBalance = this.cardSelected.balance;
    },
    sleep(time) {
      return new Promise((resolve) => setTimeout(resolve, time));
    },
    number_format(value) {
      return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
      }).format(value);
    },
    calculatorDue() {
      let pay = this.pay;
      if (pay >= this.total) {
        this.due = parseFloat(
          this.number_format(pay - this.total)
            .replace(/\./g, "")
            .replace("₫", "")
        );
      }
    },
  },
  watch: {
    payBy(v) {
      this.giftCardId = "";
      this.cardSelected = "";
    },
    total() {
      this.calculatorDue();
    },
  },
};
</script>

<style lang="css" scoped>
img#image_size {
  max-height: 100px;
  object-fit: contain;
  /* width: auto; */
}
.text-color {
  color: #ffffff;
}
.action {
  font-size: 0.575rem;
}
.pointer-events-none {
  pointer-events: none;
}

/* span.select2-container {
  width: 100%;
} */
</style>
