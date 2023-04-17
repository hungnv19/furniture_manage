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
                  <label class="" require>Name</label>
                  <Field
                    type="text"
                    name="name"
                    autocomplete="off"
                    v-model="model.name"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter name"
                  />

                  <ErrorMessage class="error" name="name" />
                </div>
                <div class="form-group">
                  <label class="" require>Email</label>
                  <Field
                    type="text"
                    name="email"
                    autocomplete="off"
                    v-model="model.email"
                    rules="required|max:128|email|unique_email"
                    class="form-control"
                    placeholder="Enter email"
                  />

                  <ErrorMessage class="error" name="email" />
                </div>
                <div class="form-group">
                  <label class="" require>Phone</label>
                  <Field
                    type="text"
                    name="phone"
                    autocomplete="off"
                    v-model="model.phone"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter phone"
                  />

                  <ErrorMessage class="error" name="phone" />
                </div>
                <div class="form-group">
                  <label class="" require>Address</label>
                  <Field
                    type="text"
                    name="address"
                    autocomplete="off"
                    v-model="model.address"
                    rules="required|max:128"
                    class="form-control"
                    placeholder="Enter address"
                  />

                  <ErrorMessage class="error" name="address" />
                </div>
                <div class="form-group">
                  <label class="form-label" for="image">Image</label>
                  <div>
                    <div
                      class="display-image"
                      id="img-preview"
                      @click="chooseImage()"
                      role="button"
                      @dragover.prevent
                      @drop="(e) => onDrop(e)"
                    >
                      <div class="align-center-text" v-if="!filePreview">
                        <span v-if="!filePreview"
                          >Đăng ký bằng cách click hoặc kéo thả</span
                        >
                      </div>
                      <div style="display: none">
                        <input
                          :type="typeFile"
                          @change="onChange"
                          ref="fileInput"
                          accept="image/*"
                          name="photo"
                          id="photo"
                        />
                      </div>
                      <div class="d-flex justify-content-center">
                        <img
                          v-if="filePreview"
                          :src="filePreview"
                          class="img"
                          style="width: 300px"
                        />
                        <span
                          @click="deleteImage"
                          class="icon_delete"
                          v-if="filePreview"
                          ><i class="fa fa-trash"></i
                        ></span>
                      </div>
                      <div class="text-center mt-3">
                        <button
                          class="rounded"
                          @click="chooseImage()"
                          type="button"
                          style="display: none"
                        >
                          アップロード
                        </button>
                      </div>
                    </div>
                  </div>
                  <span class="error" v-if="hasErrImg == true">{{
                    errMsgImage
                  }}</span>
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

      model: {
        name: "",
        email: "",
        phone: "",
        address: "",
      },
      filePreview: "",
      typeFile: "file",
      errMsgImage: "",
      hasErrImg: false,

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
    defineRule("unique_email", (value) => {
      return axios
        .post(that.data.urlCheckEmail, {
          value: value,
        })
        .then(function (response) {
          return response.data.valid;
        })
        .catch((error) => {});
    });
  },
  methods: {
    deleteImage() {
      this.typeFile = "hidden";
      this.filePreview = "";
      this.media = null;
      this.ImageNotUser = 1;
      this.hasErrImg = false;
    },
    chooseImage() {
      if (this.typeFile == "hidden") {
        this.typeFile = "file";
      }
      this.$refs["fileInput"].click();
    },
    onChange(e) {
      let Image = e.target.files[0];
      if (
        Image.type.includes("image/jpeg") ||
        Image.type.includes("image/png") ||
        Image.type.includes("image/jpg")
      ) {
        this.errMsgImage = "";
        this.hasErrImg = false;
      } else {
        this.errMsgImage = "Định dạng hình ảnh không chính xác.";
        this.hasErrImg = true;
        return;
      }
      if (Image.size >= 20971520) {
        this.errMsgImage = "Ảnh quá lớn.";
        this.hasErrImg = true;
      } else {
        this.hasErrImg = false;
      }

      this.model.photo = e.target.files[0];
      let fileInput = this.$refs.fileInput;
      let imgFile = fileInput.files;

      if (imgFile && imgFile[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.filePreview = e.target.result;
        };
        reader.readAsDataURL(imgFile[0]);
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


