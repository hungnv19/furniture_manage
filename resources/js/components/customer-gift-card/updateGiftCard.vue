
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
              >
                <Field type="hidden" :value="csrfToken" name="_token" />

                <div class="form-group">
                  <label class="" require>Gift Card</label>
                  <Field
                    class="form-select"
                    name="gift_card_id"
                    as="select"
                    aria-label="Default select example"
                    rules="required"
                    v-model="gift_card_id"
                  >
                    <option value selected>Chose Gift Card</option>
                    <option
                      v-for="item in listGiftCardAvailable"
                      :key="item.id"
                      :value="item.id"
                    >
                      {{ item.code }}
                    </option>
                  </Field>
                  <ErrorMessage class="error" name="gift_card_id" />
                </div>
                <div class="form-group">
                  <button
                    type="submit"
                    class="btn btn-primary btn-submit btn-block"
                  >
                    submit
                  </button>
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
import Select2 from "vue3-select2-component";
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
    Select2,
    ErrorMessage,
  },
  computed: {},
  props: ["idCustomerGiftCard", "giftCards", "listGiftCardAvailable"],
  data: function () {
    return {
      csrfToken: Laravel.csrfToken,
      gift_card_id: "",
      
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          gift_card_id: {
            required: "The gift card field is required.",
          },
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });
    // console.log(this.listGiftCardAvailable);
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
      let id = this.gift_card_id;
      axios
        .post("/add-customer-gift-card/" + id)
        .then(() => {
          //  alert("Them thanh cong");
          location.reload();
        })
        .catch();
      this.$refs.formData.submit();
    },
  },
};
</script>


