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
                :action="data.urlStore"
              >
                <Field type="hidden" :value="csrfToken" name="_token" />

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-12">
                      <label class="" require>Details</label>
                      <Field
                        as="textarea"
                        type="text"
                        name="details"
                        autocomplete="off"
                        v-model="model.details"
                        rules="required|max:255"
                        class="form-control"
                        placeholder="Enter details"
                        cols="30"
                        rows="10"
                      />

                      <ErrorMessage class="error" name="details" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="" require>Amount</label>
                  <Field
                    type="number"
                    name="amount"
                    autocomplete="off"
                    v-model="model.amount"
                    rules="required|min_value:1"
                    class="form-control"
                    placeholder="Enter amount"
                  />
                  <ErrorMessage class="error" name="amount" />
                </div>
                <div class="form-group">
                  <label class="" require>Expense Date</label>
                  <Field
                    type="date"
                    name="expense_date"
                    autocomplete="off"
                    v-model="model.expense_date"
                    rules="required"
                    class="form-control"
                    placeholder="Enter buying date"
                  />

                  <ErrorMessage class="error" name="expense_date" />
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
      model: [],
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          details: {
            required: "The details field is required.",
            max: "The details may not be greater than 255.",
          },
          amount: {
            required: "The amount field is required.",
            min_value: "The amount must be at least 1.",
          },
          expense_date: {
            required: "The expense_date  field is required.",
          },
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });
  },
  methods: {
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


