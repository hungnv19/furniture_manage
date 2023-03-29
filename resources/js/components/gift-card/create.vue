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
                    <div class="col-6">
                      <label class="" require>Code</label>
                      <input
                        readonly
                        name="code"
                        type="text"
                        id="exampleFormControlSelect2"
                        v-model="model.code"
                        class="form-control"
                      />
                    </div>
                    <div class="col-6">
                      <input
                        hidden
                        type="text"
                        class="form-control"
                        name="balance"
                        placeholder="Enter Balance"
                        v-model="model.balance"
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label for="exampleFormControlSelect1"> Type </label>
                      <select
                        class="form-control"
                        id="exampleFormControlSelect1"
                        @change="handleSelectType($event)"
                      >
                        <option value="" hidden disabled selected>
                          Select Card Type
                        </option>
                        <option
                          v-for="typeCard in this.dataCardType"
                          :value="typeCard.value"
                          :key="typeCard.value"
                        >
                          {{ typeCard.label }}
                        </option>
                      </select>
                      <Field
                        hidden
                        class="form-control"
                        name="type"
                        rules="required"
                        v-model="model.type"
                      />
                      <ErrorMessage class="error" name="type" />
                    </div>

                    <div class="col-md-6" v-if="showFieldType">
                      <label for="exampleFormControlSelect1"
                        >Chose card type</label
                      >
                      <Field
                        type="text"
                        class="form-control"
                        name="other"
                        rules="required|numeric|min_value:1|max_value:99999999999999"
                        id="exampleInputAddress"
                        placeholder="Chose card type"
                        v-model="model.other"
                      />
                      <ErrorMessage class="error" name="other" />
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6" hidden>
                        <input
                          type="text"
                          class="form-control"
                          name="amount"
                         
                          id="exampleInputAddress"
                          placeholder="Enter Amount"
                          v-model="model.amount"
                        />
                        
                      </div>
                    </div>
                  </div>
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
import { CardType, CardTypeDetail } from "../../enums/CardType";
import {
  StatusGiftCard,
  StatusGiftCardDetail,
} from "../../enums/StatusGiftCard";
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

  created() {
    let messError = {
      en: {
        fields: {
          
          email: {
            required: "The email field is required.",
            max: "The email may not be greater than 128.",
            unique_email: "The email already exists",
            email: "The Email must be a valid email address.",
          },
          phone: {
            required: "The phone field is required.",
            max: "The phone may not be greater than 128.",
          },
          address: {
            required: "The address field is required.",
            max: "The address may not be greater than 128.",
          },
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });
    let that = this;

    axios
      .get(this.data.urlGetCode)
      .then((res) => {
        this.model.code = res.data;
        this.dataCardType = CardType;
        this.dataStatusGiftCard = StatusGiftCard;
      })
      .catch((error) => {});
  },
  data: function () {
    return {
      csrfToken: Laravel.csrfToken,
      dataStatusGiftCard: "",
      dataCardType: "",
      showFieldType: false,

      model: {
        type: "",
        other: "",
        amount: "",
        code: "",
        balance: "",
      },
    };
  },
  methods: {
    handleSelectType(event) {
      if (event.target.value == "4") {
        this.showFieldType = true;
        this.model.type = "4";
      } else {
        this.showFieldType = false;
        this.model.type = event.target.value;
        switch (event.target.value) {
          case "1":
            this.model.amount = CardTypeDetail.TYPE200;
            this.model.balance = CardTypeDetail.TYPE200;
            break;
          case "2":
            this.model.amount = CardTypeDetail.TYPE500;
            this.model.balance = CardTypeDetail.TYPE500;
            break;
          case "3":
            this.model.amount = CardTypeDetail.TYPE1TR;
            this.model.balance = CardTypeDetail.TYPE1TR;
            break;
          default:
        }
      }
    },
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


