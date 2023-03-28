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

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-6">
                      <label class="" require>Customer</label>
                      <select
                        class="form-select"
                        name="customer_id"
                        aria-label="Default select example"
                        v-model="model.customer_id"
                      >
                        <option value disabled selected>Chọn danh muc</option>
                        <option
                          v-for="item in data.customers"
                          :key="item.id"
                          :value="item.id"
                        >
                          {{ item.label }}
                        </option>
                      </select>
                    </div>
                    <div class="col-6">
                      <label class="" require>Date</label>
                      <Field
                        type="date"
                        name="date"
                        autocomplete="off"
                        v-model="model.date"
                        rules="required"
                        class="form-control"
                        placeholder="Enter date"
                      />

                      <ErrorMessage class="error" name="date" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-6">
                      <label class="" require>Start Time</label>
                      <Field
                        type="time"
                        name="start_time"
                        autocomplete="off"
                        v-model="model.start_time"
                        rules="required"
                        class="form-control"
                        placeholder="Enter Start Time"
                      />

                      <ErrorMessage class="error" name="start_time" />
                    </div>
                    <div class="col-6">
                      <label class="" require>End Time</label>
                      <Field
                        type="time"
                        name="end_time"
                        autocomplete="off"
                        v-model="model.end_time"
                        rules="required"
                        class="form-control"
                        placeholder="Enter end time"
                      />

                      <ErrorMessage class="error" name="end_time" />
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="" require>Note</label>
                  <Field
                    type="text"
                    name="note"
                    autocomplete="off"
                    v-model="model.note"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter Note"
                  />

                  <ErrorMessage class="error" name="note" />
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
      model: this.data.appointment,
      customers: [],
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          note: {
            required: "The note field is required.",
            max: "The note may not be greater than 128.",
          },
          date: {
            required: "The date field is required.",
          },
          end_time: {
            required: "The end_time field is required.",
           
          },
          start_time: {
            required: "The start_time field is required.",
          
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


