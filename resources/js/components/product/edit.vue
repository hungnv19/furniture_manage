<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
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
                :action="data.urlUpdate"
              >
                <Field type="hidden" :value="csrfToken" name="_token" />
                <Field type="hidden" value="PUT" name="_method" />
                <div class="form-group">
                  <select
                    class="form-select"
                    name="category_id"
                    aria-label="Default select example"
                    v-model="model.category_id"
                  >
                    <option value disabled selected>Chọn danh muc</option>
                    <option
                      v-for="item in data.categories"
                      :key="item.id"
                      :value="item.id"
                    >
                      {{ item.label }}
                    </option>
                  </select>
                </div>

                <div class="form-group">
                  <label class="" require>product_name</label>
                  <Field
                    type="text"
                    name="product_name"
                    autocomplete="off"
                    v-model="model.product_name"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter product_name"
                  />

                  <ErrorMessage class="error" name="product_name" />
                </div>
                <div class="form-group">
                  <label class="" require>product_code</label>
                  <Field
                    type="text"
                    name="product_code"
                    autocomplete="off"
                    v-model="model.product_code"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter product_code"
                  />

                  <ErrorMessage class="error" name="product_code" />
                </div>
                <div class="form-group">
                  <label class="" require>root</label>
                  <Field
                    type="text"
                    name="root"
                    autocomplete="off"
                    v-model="model.root"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter root"
                  />

                  <ErrorMessage class="error" name="root" />
                </div>
                <div class="form-group">
                  <label class="" require>buying_price</label>
                  <Field
                    type="number"
                    name="buying_price"
                    autocomplete="off"
                    v-model="model.buying_price"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter buying_price"
                  />

                  <ErrorMessage class="error" name="buying_price" />
                </div>
                <div class="form-group">
                  <label class="" require>selling_price</label>
                  <Field
                    type="number"
                    name="selling_price"
                    autocomplete="off"
                    v-model="model.selling_price"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter selling_price"
                  />

                  <ErrorMessage class="error" name="selling_price" />
                </div>
                <div class="form-group">
                  <label class="" require>selling_price</label>
                  <Field
                    type="number"
                    name="selling_price"
                    autocomplete="off"
                    v-model="model.selling_price"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter selling_price"
                  />

                  <ErrorMessage class="error" name="selling_price" />
                </div>
                <div class="form-group">
                  <label class="" require>selling_price</label>
                  <Field
                    type="number"
                    name="selling_price"
                    autocomplete="off"
                    v-model="model.selling_price"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter selling_price"
                  />

                  <ErrorMessage class="error" name="selling_price" />
                </div>
                <div class="form-group">
                  <label class="" require>buying_date</label>
                  <Field
                    type="date"
                    name="buying_date"
                    autocomplete="off"
                    v-model="model.buying_date"
                    rules="required"
                    class="form-control"
                    placeholder="Enter buying_date"
                  />

                  <ErrorMessage class="error" name="buying_date" />
                </div>
                <div class="form-group">
                  <label class="" require>product_quantity</label>
                  <Field
                    type="number"
                    name="product_quantity"
                    autocomplete="off"
                    v-model="model.product_quantity"
                    rules="required"
                    class="form-control"
                    placeholder="Enter product_quantity"
                  />

                  <ErrorMessage class="error" name="product_quantity" />
                </div>

                <div class="col-md-12 text-center btn-box">
                  <a
                    :href="data.urlBack"
                    class="btn btn-outline-secondary"
                    style="margin-right: 10px"
                  >
                    Back
                  </a>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </VeeForm>
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
  computed: {},
  props: ["data"],
  data: function () {
    return {
      csrfToken: Laravel.csrfToken,

      model: this.data.product,
      categories: [],
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          name: {
            required: "The name field is required.",
            max: "The name may not be greater than 128.",
          },
          email: {
            required: "The email field is required.",
            max: "The email may not be greater than 128.",
          },
          password: {
            required: "The password field is required.",
            max: "The password may not be greater than 128.",
          },
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });
  },
  methods: {
    updateSelected(e) {
      let array = [];
      e.map((x) => {
        array.push(x.value);
      });
      array = [...new Set(array)];
      this.skill = array;
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
      this.$refs.formData.submit();
    },
  },
};
</script>


