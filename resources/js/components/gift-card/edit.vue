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
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-6">
                      <label for="exampleFormControlSelect1">Balance</label>
                      <Field
                        type="text"
                        rules="required|min_value:1|max_value:99999999999999"
                        class="form-control"
                        name="balance"
                        placeholder="Enter Balance"
                        v-model="model.balance"
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
          balance: {
            required: "The balance field is required.",
            min_value: "The balance must be at least 1.",
            max_value: "The balance may not be greater than 99999999999999.",
          },
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });

    this.dataCardType = CardType;
    this.dataStatusGiftCard = StatusGiftCard;
  },
  data: function () {
    return {
      csrfToken: Laravel.csrfToken,
      dataStatusGiftCard: "",
      dataCardType: "",

      model: this.data.giftCard,
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


