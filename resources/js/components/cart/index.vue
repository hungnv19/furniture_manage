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
              <div class="col align-self-center text-right text-muted"></div>
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
                <tr v-for="po in data.pos" :key="po.id">
                  <td>{{ po.product_name }}</td>
                  <td>
                    <div
                      class="d-flex justify-content-center bootstrap-touchspin bootstrap-touchspin-injected"
                    >
                      <span
                        class="d-flex justify-content-center"
                        style="width: 30px"
                      >
                        <div>{{ po.product_quantity }}</div>
                      </span>
                    </div>
                  </td>
                  <td>{{ number_format(po.product_price) }}</td>
                  <td>{{ number_format(po.sub_total) }}</td>
                  <td>
                    <a
                      @click="deleteItem(po.id)"
                      class="btn btn-sm btn-danger action"
                      style="color: white"
                      >X</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-4 summary">
          <div class="card-footer">
            <div class="order-md-2 mb-4">
              <ul class="list-group mb-3">
                <li
                  class="list-group-item d-flex justify-content-between lh-condensed"
                >
                  <div>
                    <h6 class="my-0">Total Quantity</h6>
                  </div>
                  <span class="text-muted">{{ qty }}</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between lh-condensed"
                >
                  <div>
                    <h6 class="my-0">Sub Total</h6>
                  </div>
                  <span class="text-muted">{{ number_format(sub_total) }}</span>
                </li>

                <li
                  class="list-group-item d-flex justify-content-between lh-condensed"
                >
                  <div>
                    <h6 class="my-0">Vat</h6>
                  </div>
                  <span class="text-muted">{{ this.data.extra.vat }}%</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between bg-light"
                >
                  <div class="text-success">
                    <h6 class="my-0">Total</h6>
                  </div>
                  <span class="text-success">{{ number_format(total) }}</span>
                </li>
                <li
                  v-if="giftCardId"
                  class="list-group-item d-flex justify-content-between lh-condensed"
                >
                  <div>
                    <h6 class="my-0">Gift Card</h6>
                  </div>
                  <span class="text-muted"> - {{ number_format(total) }}</span>
                </li>
              </ul>

              <VeeForm
                as="div"
                v-slot="{ handleSubmit }"
                class="form-owner"
                @invalid-submit="onInvalidSubmit"
              >
                <form
                  method="POST"
                  @submit="handleSubmit($event, onSubmit)"
                  ref="formData"
                  enctype="multipart/form-data"
                >
                  <Field type="hidden" :value="csrfToken" name="_token" />

                  <div class="form-group">
                    <label class="" require>Customer</label>
                    <Field
                      class="form-select"
                      name="customer_id"
                      as="select"
                      aria-label="Default select example"
                      rules="required"
                      v-model="customer_id"
                    >
                      <option value disabled selected>Chose Customers</option>
                      <option
                        v-for="item in data.customers"
                        :key="item.id"
                        :value="item.id"
                      >
                        {{ item.label }}
                      </option>
                    </Field>
                    <ErrorMessage class="error" name="customer_id" />
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlSelect2">Pay By</label>
                    <Field
                      class="form-select"
                      id="exampleFormControlSelect2"
                      name="payBy"
                      as="select"
                      v-model="payBy"
                      rules="required"
                    >
                      <option value disabled selected>Chose Pay By</option>
                      <option value="handCash">Hand Cash</option>
                      <option value="giftCard">Gift Card</option>
                    </Field>

                    <ErrorMessage class="error" name="payBy" />
                  </div>

                  <div v-if="payBy === 'giftCard'" class="form-group">
                    <label for="exampleFormControlSelect2">Gift Card</label>
                    <Select2
                      @select="selectGiftCard($event)"
                      :options="giftCardOptions"
                      placeholder="select_card"
                    />
                    <Field
                      type="hidden"
                      name="gift_card_id"
                      v-model="giftCardId"
                      rules="required"
                    />
                    <ErrorMessage class="error" name="gift_card_id" />
                  </div>
                  <div v-if="payBy === 'handCash'">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Pay</label>
                      <Field
                        type="text"
                        class="form-control"
                        v-model="pay"
                        rules="required|numeric"
                        name="pay"
                        id="exampleFormControlInput1"
                        @keyup="calculatorDue"
                      />

                      <ErrorMessage class="error" name="pay" />
                    </div>
                    <div class="form-group">
                      <div class="d-flex justify-content-between">
                        <label for="exampleFormControlInput2">Due</label>
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
                  </div>

                  <button class="btn btn-success" type="submit">submit</button>
                </form>
              </VeeForm>

              <!-- <form @submit.prevent="orderDone">
                
              </form> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {
  Form as VeeForm,
  Field,
  ErrorMessage,
  defineRule,
  configure,
} from "vee-validate";
import { localize } from "@vee-validate/i18n";
import * as rules from "@vee-validate/rules";
import $ from "jquery";
export default {
  setup() {
    Object.keys(rules).forEach((rule) => {
      if (rule != "default") {
        defineRule(rule, rules[rule]);
      }
    });
  },
  components: {
    VeeForm,
    Field,
    ErrorMessage,
  },
  created() {
    let messError = {
      en: {
        fields: {
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
      },
    };
    configure({
      generateMessage: localize(messError),
    });
  },
  props: ["data"],
  mounted() {
    this.cartProducts();
  },

  data() {
    return {
      pos: [],
      cartProduct: [],
      customers: [],
      customer_id: "",
      pay: "",
      due: "",
      payBy: "",
      gift_card_id: "",
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
            ((this.sub_total * this.data.extra.vat) / 100 + this.sub_total) *
              100
          ) / 100
        )
          .replace(/\./g, "")
          .replace("₫", "")
      );
    },
  },

  methods: {
    cartProducts() {
      axios
        .get("/cart-products")
        .then(({ data }) => (this.cartProduct = data))
        .catch();
    },
    onInvalidSubmit({ values, errors, results }) {
      let firstInputError = Object.entries(errors)[0][0];
      this.$el.querySelector("input[name=" + firstInputError + "]").focus();
      $("html, body").animate(
        {
          scrollTop:
            $("input[name=" + firstInputError + "]").offset().top - 150,
        },
        500
      );
    },
    onSubmit() {
      // this.$refs.formData.submit();
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
    number(string) {
      return string;
    },
    deleteItem(id) {
      axios
        .get("/cart/delete/" + id)
        .then(() => {
          location.reload();
          alert("Xoa thanh cong");
        })
        .catch();
    },
    number_format(value) {
      return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
      }).format(value);
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