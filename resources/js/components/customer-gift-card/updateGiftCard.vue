
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
                  <Select2
                    @select="selectGiftCard($event)"
                    :options="myOptions"
                    v-model="model.id"
                  />
                  <Field hidden name="id" rules="required" v-model="form.id" />
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
  props: ["data", "idCustomerGiftCard"],
  data: function () {
    return {
      csrfToken: Laravel.csrfToken,

      model: {
        id: "",
      },
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          id: {
            required: "The id field is required.",
            
          },
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });
  },
  methods: {
     selectGiftCard(e) {
      this.form.id = e.id;
    },
    getGiftCardList() {
      axios
        .get("/gift-card-list")
        .then((res) => {
          res.data.map((e) => {
            this.myOptions.push({ id: e.id, text: e.code });
          });
        })
        .catch();
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


